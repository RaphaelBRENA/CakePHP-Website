<?php
declare(strict_types=1);

namespace App\Controller;

use Cake\Http\Client;
use Dompdf\Dompdf;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use Cake\Http\Response;
use PhpOffice\PhpPresentation\PhpPresentation;
use PhpOffice\PhpPresentation\IOFactory as PresentationIOFactory;
use PhpOffice\PhpPresentation\Style\Alignment;
use PhpOffice\PhpWord\PhpWord;
use PhpOffice\PhpWord\IOFactory as WordIOFactory;

class ShoppingListController extends AppController
{
    public function beforeFilter(\Cake\Event\EventInterface $event)
    {
        parent::beforeFilter($event);

        $this->Authentication->allowUnauthenticated(['exportExcel', 'exportPowerPoint', 'exportWord', 'exportTxt', 'index', 'exportPDF', 'exportJson', 'exportPng', 'fetchIngredientsList', 'exportXml', 'exportCsv', 'stores']);
    }
    private function fetchIngredientsList(): array
    {
        $cart = $this->request->getSession()->read('Cart') ?? [];
        if (empty($cart)) {
            return [];
        }
        $recipeIds = array_keys($cart);
        $recipesTable = $this->fetchTable('Recipes');
        $recipes = $recipesTable->find('all')
            ->contain(['Ingredients'])
            ->where(['Recipes.id IN' => $recipeIds])
            ->all();
        $ingredientsList = [];
        foreach ($recipes as $recipe) {
            $recipeCartQuantity = $cart[$recipe->id]['quantity'];
            foreach ($recipe->ingredients as $ingredient) {
                $ingredientQuantityInRecipe = $ingredient->_joinData->quantity;
                $totalIngredientQuantity = $recipeCartQuantity * $ingredientQuantityInRecipe / $recipe->servings;
                if (isset($ingredientsList[$ingredient->id])) {
                    $ingredientsList[$ingredient->id]['quantity'] += $totalIngredientQuantity;
                } else {
                    $ingredientsList[$ingredient->id] = [
                        'id' => $ingredient->id,
                        'name' => $ingredient->name,
                        'unit' => $ingredient->unit,
                        'quantity' => $totalIngredientQuantity,
                    ];
                }
            }
        }
        return $ingredientsList;
    }

    public function index()
    {
        $ingredientsList = $this->fetchIngredientsList();
        $this->set(compact('ingredientsList'));
    }

    public function exportPDF()
    {
        $ingredientsList = $this->fetchIngredientsList();
        if (empty($ingredientsList)) {
            $this->Flash->error("Votre panier est vide.");
            return $this->redirect(["action" => "index"]);
        }
        $html = '<!DOCTYPE html>';
        $html .= '<html lang="fr">';
        $html .= '<head>';
        $html .= '<meta charset="UTF-8">';
        $html .= '<style>';
        $html .= 'body { font-family: Arial, sans-serif; margin: 20px; }';
        $html .= 'h1 { text-align: center; color: #333; }';
        $html .= 'table { width: 100%; border-collapse: collapse; margin-top: 20px; }';
        $html .= 'th, td { border: 1px solid #ddd; padding: 8px; text-align: left; }';
        $html .= 'th { background-color: #f2f2f2; }';
        $html .= 'tr:nth-child(even) { background-color: #f9f9f9; }';
        $html .= '</style>';
        $html .= '</head>';
        $html .= '<body>';
        $html .= '<h1>Liste de courses</h1>';
        $html .= '<table>';
        $html .= '<tr><th>Nom</th><th>Quantité</th><th>Unité</th></tr>';
        foreach ($ingredientsList as $ingredient) {
            $html .= '<tr>';
            $html .= '<td>' . $ingredient['name'] . '</td>';
            $html .= '<td>' . $ingredient['quantity'] . '</td>';
            $html .= '<td>' . $ingredient['unit'] . '</td>';
            $html .= '</tr>';
        }
        $html .= '</table>';
        $html .= '</body>';
        $html .= '</html>';
        $dompdf = new Dompdf();
        $dompdf->loadHtml($html);
        $dompdf->render();
        $response = new Response();
        $response = $response->withType('application/pdf');
        $response = $response->withStringBody($dompdf->output());
        $response = $response->withHeader('Content-Disposition', 'attachment; filename="liste_de_courses.pdf"');
        return $response;
    }

    public function exportExcel()
    {
        $ingredientsList = $this->fetchIngredientsList();
        if (empty($ingredientsList)) {
            $this->Flash->error("Votre panier est vide.");
            return $this->redirect(["action" => "index"]);
        }
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();
        $sheet->setCellValue('A1', 'Nom');
        $sheet->setCellValue('B1', 'Quantité');
        $sheet->setCellValue('C1', 'Unité');
        $row = 2;
        foreach ($ingredientsList as $ingredient) {
            $sheet->setCellValue('A' . $row, $ingredient['name']);
            $sheet->setCellValue('B' . $row, $ingredient['quantity']);
            $sheet->setCellValue('C' . $row, $ingredient['unit']);
            $row++;
        }
        $writer = new Xlsx($spreadsheet);
        $tempFile = tempnam(sys_get_temp_dir(), 'liste_de_courses') . '.xlsx';
        $writer->save($tempFile);
        $response = new Response();
        $response = $response->withFile($tempFile, [
            'download' => true,
            'name' => 'liste_de_courses.xlsx'
        ]);
        return $response;
    }

    public function exportPowerPoint()
    {
        $ingredientsList = $this->fetchIngredientsList();
        if (empty($ingredientsList)) {
            $this->Flash->error("Votre panier est vide.");
            return $this->redirect(["action" => "index"]);
        }
        $presentation = new PhpPresentation();
        $titleSlide = $presentation->getActiveSlide();
        $titleShape = $titleSlide->createRichTextShape();
        $titleShape->setHeight(200);
        $titleShape->setWidth(600);
        $titleShape->setOffsetX(175);
        $titleShape->setOffsetY(150);
        $titleShape->getActiveParagraph()->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
        $titleShape->getActiveParagraph()->createTextRun('Liste de courses')->getFont()->setBold(true)->setSize(36);
        foreach ($ingredientsList as $ingredient) {
            $slide = $presentation->createSlide();
            $ingredientTitleShape = $slide->createRichTextShape();
            $ingredientTitleShape->setHeight(100);
            $ingredientTitleShape->setWidth(600);
            $ingredientTitleShape->setOffsetX(175);
            $ingredientTitleShape->setOffsetY(250);
            $ingredientTitleShape->getActiveParagraph()->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
            $ingredientTitleShape->getActiveParagraph()->createTextRun($ingredient['name'])->getFont()->setBold(true)->setSize(24);
            $detailsShape = $slide->createRichTextShape();
            $detailsShape->setHeight(200);
            $detailsShape->setWidth(600);
            $detailsShape->setOffsetX(175);
            $detailsShape->setOffsetY(375);
            $detailsShape->getActiveParagraph()->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
            $detailsShape->getActiveParagraph()->createTextRun("Quantité: " . $ingredient['quantity'] . " " . $ingredient['unit'])->getFont()->setSize(18);
        }
        $writer = PresentationIOFactory::createWriter($presentation, 'PowerPoint2007');
        $tempFile = tempnam(sys_get_temp_dir(), 'liste_de_courses') . '.pptx';
        $writer->save($tempFile);
        $response = new Response();
        $response = $response->withFile($tempFile, [
            'download' => true,
            'name' => 'liste_de_courses.pptx'
        ]);
        return $response;
    }

    public function exportWord()
    {
        $ingredientsList = $this->fetchIngredientsList();
        if (empty($ingredientsList)) {
            $this->Flash->error("Votre panier est vide.");
            return $this->redirect(["action" => "index"]);
        }
        $phpWord = new PhpWord();
        $section = $phpWord->addSection();
        $section->addTitle('Liste de courses', 16);
        $table = $section->addTable(['borderSize' => 6, 'borderColor' => 'black', 'cellMargin' => 80]);
        $table->addRow();
        $table->addCell()->addText('Nom', ['bold' => true]);
        $table->addCell()->addText('Quantité', ['bold' => true]);
        $table->addCell()->addText('Unité', ['bold' => true]);
        foreach ($ingredientsList as $ingredient) {
            $table->addRow();
            $table->addCell()->addText($ingredient['name']);
            $table->addCell()->addText($ingredient['quantity']);
            $table->addCell()->addText($ingredient['unit']);
        }
        $writer = WordIOFactory::createWriter($phpWord, 'Word2007');
        $tempFile = tempnam(sys_get_temp_dir(), 'liste_de_courses') . '.docx';
        $writer->save($tempFile);
        $response = new Response();
        $response = $response->withFile($tempFile, [
            'download' => true,
            'name' => 'liste_de_courses.docx'
        ]);
        return $response;
    }

    public function exportPng()
    {
        $ingredientsList = $this->fetchIngredientsList();
        if (empty($ingredientsList)) {
            $this->Flash->error("Votre panier est vide.");
            return $this->redirect(["action" => "index"]);
        }
        $imageWidth = 800;
        $imageHeight = 600;
        $image = imagecreatetruecolor($imageWidth, $imageHeight);
        $backgroundColor = imagecolorallocate($image, 255, 255, 255);
        imagefilledrectangle($image, 0, 0, $imageWidth, $imageHeight, $backgroundColor);
        $textColor = imagecolorallocate($image, 0, 0, 0);
        $x = 50;
        $y = 50;
        $lineHeight = 30;
        $title = "Liste de courses";
        imagestring($image, 5, $x, $y, $title, $textColor);
        $y += $lineHeight;
        foreach ($ingredientsList as $ingredient) {
            $ingredientText = $ingredient['name'] . ' - ' . $ingredient['quantity'] . ' ' . $ingredient['unit'];
            imagestring($image, 5, $x, $y, $ingredientText, $textColor);
            $y += $lineHeight;
        }
        header('Content-Type: image/png');
        imagepng($image);
        imagedestroy($image);
        exit();
    }

    public function exportTxt()
    {
        $ingredientsList = $this->fetchIngredientsList();
        if (empty($ingredientsList)) {
            $this->Flash->error("Votre panier est vide.");
            return $this->redirect(["action" => "index"]);
        }
        $content = "Liste de courses\n\n";
        foreach ($ingredientsList as $ingredient) {
            $content .= $ingredient['name'] . ' - ' . $ingredient['quantity'] . ' ' . $ingredient['unit'] . "\n";
        }
        $txtFilePath = tempnam(sys_get_temp_dir(), 'liste_de_courses') . '.txt';
        file_put_contents($txtFilePath, $content);
        $response = new Response();
        $response = $response->withFile($txtFilePath, [
            'download' => true,
            'name' => 'liste_de_courses.txt'
        ]);
        return $response;
    }

    public function exportJson()
    {
        $ingredientsList = $this->fetchIngredientsList();
        if (empty($ingredientsList)) {
            $this->Flash->error("Votre panier est vide.");
            return $this->redirect(["action" => "index"]);
        }
        $jsonContent = json_encode(array_values($ingredientsList), JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
        $this->response = $this->response->withType('application/json');
        $this->response = $this->response->withStringBody($jsonContent);
        return $this->response;
    }

    public function exportXml()
    {
        $ingredientsList = $this->fetchIngredientsList();
        if (empty($ingredientsList)) {
            $this->Flash->error("Votre panier est vide.");
            return $this->redirect(["action" => "index"]);
        }
        $xml = new \SimpleXMLElement('<ShoppingList/>');
        foreach ($ingredientsList as $ingredient) {
            $item = $xml->addChild('Item');
            $item->addChild('Name', htmlspecialchars($ingredient['name']));
            $item->addChild('Quantity', htmlspecialchars((string)$ingredient['quantity']));
            $item->addChild('Unit', htmlspecialchars($ingredient['unit']));
        }
        $xmlContent = $xml->asXML();
        $tempFile = tempnam(sys_get_temp_dir(), 'liste_de_courses') . '.xml';
        file_put_contents($tempFile, $xmlContent);
        $response = new Response();
        $response = $response->withFile($tempFile, [
            'download' => true,
            'name' => 'liste_de_courses.xml'
        ]);
        return $response;
    }
    public function exportCsv()
    {
        $ingredientsList = $this->fetchIngredientsList();
        if (empty($ingredientsList)) {
            $this->Flash->error("Votre panier est vide.");
            return $this->redirect(["action" => "index"]);
        }
        $tempFile = tempnam(sys_get_temp_dir(), 'liste_de_courses') . '.csv';
        $file = fopen($tempFile, 'w');
        fputcsv($file, ['Nom', 'Quantité', 'Unité']);
        foreach ($ingredientsList as $ingredient) {
            fputcsv($file, [
                $ingredient['name'],
                $ingredient['quantity'],
                $ingredient['unit']
            ]);
        }
        fclose($file);
        $response = new Response();
        $response = $response->withFile($tempFile, [
            'download' => true,
            'name' => 'liste_de_courses.csv'
        ]);
        return $response;
    }

    public function stores()
    {
        $apiKey = \Cake\Core\Configure::read('GoogleMaps.apiKey');
        $latitude = 46.200000;
        $longitude = 5.216667;
        $radius = 5000;
        $type = 'supermarket|grocery_or_supermarket';

        $http = new Client();
        $response = $http->get("https://maps.googleapis.com/maps/api/place/nearbysearch/json", [
            'location' => "$latitude,$longitude",
            'radius' => $radius,
            'type' => $type,
            'key' => $apiKey
        ]);
        $data = $response->getJson();
        $this->set(compact('data'));
    }
}
