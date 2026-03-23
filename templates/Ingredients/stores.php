    <script src="https://maps.googleapis.com/maps/api/js?key=<?= \Cake\Core\Configure::read('GoogleMaps.apiKey') ?>&callback=initMap&libraries=places" async defer></script>
    <script>
        let map;
        function initMap() {
            const pos = { lat: 46.200000, lng: 5.216667 };
            map = new google.maps.Map(document.getElementById("map"), {
                center: pos,
                zoom: 13,
            });
            const infoWindow = new google.maps.InfoWindow();
            <?php if (!empty($data['results'])): ?>
            <?php foreach ($data['results'] as $place): ?>
            (function() {
                const marker = new google.maps.Marker({
                    position: { lat: <?= $place['geometry']['location']['lat'] ?>, lng: <?= $place['geometry']['location']['lng'] ?> },
                    map,
                    title: "<?= addslashes($place['name']) ?>"
                });
                const contentString = `
                            <div>
                                <h3><?= addslashes($place['name']) ?></h3>
                                <p><strong>Adresse :</strong> <?= addslashes($place['vicinity'] ?? 'Non disponible') ?></p>
                                <?php if (isset($place['rating'])): ?>
                                    <p><strong>Note :</strong> <?= $place['rating'] ?>/5</p>
                                <?php endif; ?>
                                <a href="https://www.google.com/maps/search/?api=1&query=<?= urlencode($place['name']) ?>" target="_blank">
                                    Voir sur Google Maps
                                </a>
                            </div>
                        `;
                marker.addListener("click", () => {
                    infoWindow.setContent(contentString);
                    infoWindow.open(map, marker);
                });
            })();
            <?php endforeach; ?>
            <?php endif; ?>
            document.getElementById('no-js-list').style.display = 'none';
        }
    </script>
    <style>
        #map { height: 500px; width: 100%; }
        #no-js-list {
            margin-top: 20px;
        }
        .store-item {
            margin-bottom: 20px;
            padding: 15px;
            border: 1px solid #ddd;
            border-radius: 5px;
        }
        .store-name {
            font-weight: bold;
            font-size: 18px;
            margin-bottom: 8px;
        }
        .store-address {
            color: #555;
        }
        .store-rating {
            margin-top: 5px;
            color: #f90;
        }
        .store-link {
            display: inline-block;
            margin-top: 8px;
            color: #0066cc;
        }
    </style>
<h1>Magasins Alimentaires à Proximité</h1>

<!--avec JavaScript-->
<div id="map"></div>

<!--sans JavaScript-->
<div id="no-js-list">
    <h2>Liste des magasins</h2>
    <?php if (!empty($data['results'])): ?>
        <div class="stores-list">
            <?php foreach ($data['results'] as $place): ?>
                <div class="store-item">
                    <div class="store-name"><?= h($place['name']) ?></div>
                    <div class="store-address"><strong>Adresse :</strong> <?= h($place['vicinity'] ?? 'Non disponible') ?></div>
                    <?php if (isset($place['rating'])): ?>
                        <div class="store-rating"><strong>Note :</strong> <?= $place['rating'] ?>/5</div>
                    <?php endif; ?>
                    <a class="store-link" href="https://www.google.com/maps/search/?api=1&query=<?= urlencode($place['name']) ?>" target="_blank">
                        Voir sur Google Maps
                    </a>
                </div>
            <?php endforeach; ?>
        </div>
    <?php else: ?>
        <p>Aucun magasin trouvé dans cette zone.</p>
    <?php endif; ?>
</div>

<noscript>
    <style>
        #map { display: none; }
    </style>
</noscript>
