let scene, camera, renderer, rat, cheese = [];
let cheeseCount = 0;
const MAX_CHEESE = 5;
const moveSpeed = 0.05;
const keys = { up: false, down: false, left: false, right: false };
const cheesePositions = [];
const objectsInScene = [];
const collisionObjects = [];

function init() {
    scene = new THREE.Scene();
    scene.background = new THREE.Color(0x87CEEB);

    camera = new THREE.PerspectiveCamera(60, window.innerWidth / window.innerHeight, 0.1, 1000);
    camera.position.set(0, 10, 15);

    renderer = new THREE.WebGLRenderer({ antialias: true });
    renderer.setSize(window.innerWidth, window.innerHeight);
    renderer.shadowMap.enabled = true;
    document.body.appendChild(renderer.domElement);

    const controls = new THREE.OrbitControls(camera, renderer.domElement);
    controls.target.set(0, 0, 0);
    controls.update();

    setupLighting();
    createKitchen();
    loadRat();
    for (let i = 0; i < MAX_CHEESE; i++) {
        generateCheese();
    }
    window.addEventListener('resize', onWindowResize);
    setupKeyControls();
}

function setupLighting() {
    const ambientLight = new THREE.AmbientLight(0xffffff, 0.6);
    scene.add(ambientLight);
    const mainLight = new THREE.DirectionalLight(0xffffff, 0.8);
    mainLight.position.set(5, 10, 7);
    mainLight.castShadow = true;
    mainLight.shadow.mapSize.width = 2048;
    mainLight.shadow.mapSize.height = 2048;
    mainLight.shadow.camera.left = -15;
    mainLight.shadow.camera.right = 15;
    mainLight.shadow.camera.top = 15;
    mainLight.shadow.camera.bottom = -15;
    scene.add(mainLight);
    const light1 = new THREE.PointLight(0xffffcc, 1, 10);
    light1.position.set(3, 3, 3);
    scene.add(light1);
    const light2 = new THREE.PointLight(0xffffcc, 1, 10);
    light2.position.set(-3, 3, -3);
    scene.add(light2);
}

function createKitchen() {
    const loader = new THREE.GLTFLoader();
    for (let x = -3; x <= 3; x++) {
        for (let z = -3; z <= 3; z++) {
            loadModel(loader, 'floor_kitchen.gltf', x * 2, 0, z * 2, 0.5, false);
        }
    }
    for (let x = -3; x <= 3; x++) {
        loadModel(loader, 'wall.gltf', x * 2, 0, -7, 0.5, true);
    }
    for (let z = -3; z <= 3; z++) {
        loadModel(loader, 'wall.gltf', -7, 0, z * 2, 0.5, true, Math.PI / 2);
    }
    // mur droit
    loadModel(loader, 'wall.gltf', 7, 0, -6, 0.5, true, Math.PI / 2);
    loadModel(loader, 'wall.gltf', 7, 0, -4, 0.5, true, Math.PI / 2);
    loadModel(loader, 'wall.gltf', 7, 0, -2, 0.5, true, Math.PI / 2);
    loadModel(loader, 'wall_window_open.gltf', 7, 0, 0, 0.5, true, Math.PI / 2);
    loadModel(loader, 'wall.gltf', 7, 0, 2, 0.5, true, Math.PI / 2);
    loadModel(loader, 'wall.gltf', 7, 0, 4, 0.5, true, Math.PI / 2);
    loadModel(loader, 'wall.gltf', 7, 0, 6, 0.5, true, Math.PI / 2);

    // Mur avant
    loadModel(loader, 'wall.gltf', -6, 0, 7, 0.5, true);
    loadModel(loader, 'wall.gltf', -4, 0, 7, 0.5, true);
    loadModel(loader, 'wall.gltf', -2, 0, 7, 0.5, true);
    loadModel(loader, 'wall_window_open.gltf', 0, 0, 7, 0.5, true);
    loadModel(loader, 'wall.gltf', 2, 0, 7, 0.5, true);
    loadModel(loader, 'wall.gltf', 4, 0, 7, 0.5, true);
    loadModel(loader, 'wall.gltf', 6, 0, 7, 0.5, true);

    loadModel(loader, 'kitchencounter_straight_A_backsplash.gltf', -4, 0.3, -6.5, 0.5, true);
    loadModel(loader, 'kitchencounter_straight_A_backsplash.gltf', -2, 0.3, -6.5, 0.5, true);
    loadModel(loader, 'kitchencounter_sink_backsplash.gltf', 0, 1, -6.5, 0.5, true);
    loadModel(loader, 'kitchencounter_straight_A_backsplash.gltf', 2, 0.3, -6.5, 0.5, true);
    loadModel(loader, 'kitchencounter_straight_A_backsplash.gltf', 4, 0.3, -6.5, 0.5, true);

    loadModel(loader, 'kitchencabinet.gltf', -4, 0, -6.85, 0.4, true);
    loadModel(loader, 'kitchencabinet.gltf', -2, 0, -6.85, 0.4, true);
    loadModel(loader, 'kitchencabinet.gltf', 2, 0, -6.85, 0.4, true);
    loadModel(loader, 'kitchencabinet.gltf', 4, 0, -6.85, 0.4, true);

    loadModel(loader, 'fridge_A_decorated.gltf', -6.5, 0, -4, 0.5, true, Math.PI / 2);
    loadModel(loader, 'oven.gltf', 0, 0, -6.5, 0.5, true);

    loadModel(loader, 'table_round_A.gltf', 3, 0.4, 0.5, 0.5, true);

    loadModel(loader, 'jar_A_large.gltf', -4, 0.75, -6.25, 0.5, false);
    loadModel(loader, 'ketchup.gltf', 4, 0.75, -6.25, 0.5, false);

    loadModel(loader, 'bowl.gltf', 3.3, 0.9, 0.3, 0.5, false);

    loadModel(loader, 'pot_A.gltf', 2, 0.75, -6.25, 0.5, false);

    loadModel(loader, 'crate_cheese.gltf', -5.4, 0.3, 4, 0.5, true);
    loadModel(loader, 'crate_tomatoes.gltf', -5.4, 0.3, 2, 0.5, true);
    loadModel(loader, 'crate_carrots.gltf', -5.4, 0.3, 0, 0.5, true);
}

function loadModel(loader, modelName, x, y, z, scale, isCollision, rotation = 0) {
    loader.load(`/gltf/${modelName}`, (gltf) => {
        const model = gltf.scene;
        model.position.set(x, y, z);
        model.scale.set(scale, scale, scale);
        if (rotation !== 0) {
            model.rotation.y = rotation;
        }

        model.traverse(function(node) {
            if (node.isMesh) {
                node.castShadow = true;
                node.receiveShadow = true;
            }
        });

        scene.add(model);
        objectsInScene.push(model);

        if (isCollision) {
            model.userData = { type: 'obstacle' };
            collisionObjects.push(model);
        }
    });
}

function loadRat() {
    const loader = new THREE.GLTFLoader();
    loader.load('/gltf/street_rat_4k.gltf', (gltf) => {
        rat = gltf.scene;
        rat.position.set(0, 0.3, 4);
        rat.scale.set(10.5, 10.5, 10.5);
        rat.rotation.y = Math.PI;

        rat.traverse(function(node) {
            if (node.isMesh) {
                node.castShadow = true;
                node.receiveShadow = true;
                node.material = new THREE.MeshStandardMaterial({ color: 0x532200 });

            }
        });

        scene.add(rat);
        camera.lookAt(rat.position);
    });
}

function generateCheese() {
    let x, z;
    let validPosition = false;

    while (!validPosition) {
        x = (Math.random() * 10) - 5;
        z = (Math.random() * 10) - 5;
        validPosition = true;
        for (let pos of cheesePositions) {
            if (Math.sqrt(Math.pow(pos.x - x, 2) + Math.pow(pos.z - z, 2)) < 1) {
                validPosition = false;
                break;
            }
        }
        if (validPosition) {
            for (let obj of collisionObjects) {
                const objPos = new THREE.Vector3(obj.position.x, 0, obj.position.z);
                const cheesePos = new THREE.Vector3(x, 0, z);
                if (objPos.distanceTo(cheesePos) < 0.8) {
                    validPosition = false;
                    break;
                }
            }
        }
    }
    cheesePositions.push({ x, z });
    const loader = new THREE.GLTFLoader();
    loader.load('/gltf/food_ingredient_cheese_slice.gltf', (gltf) => {
        const cheeseModel = gltf.scene;
        cheeseModel.position.set(x, 0.3, z);
        cheeseModel.scale.set(0.5, 0.5, 0.5);
        cheeseModel.traverse(function(node) {
            if (node.isMesh) {
                node.castShadow = true;
                node.receiveShadow = true;
            }
        });

        cheeseModel.userData = { type: 'cheese', id: cheese.length };
        scene.add(cheeseModel);
        cheese.push({ model: cheeseModel, position: { x, z } });
    });
}

function setupKeyControls() {
    window.addEventListener('keydown', (e) => {
        switch(e.key) {
            case 'ArrowUp':
            case 'z':
            case 'Z':
                keys.up = true;
                break;
            case 'ArrowDown':
            case 's':
            case 'S':
                keys.down = true;
                break;
            case 'ArrowLeft':
            case 'q':
            case 'Q':
                keys.left = true;
                break;
            case 'ArrowRight':
            case 'd':
            case 'D':
                keys.right = true;
                break;
        }
    });

    window.addEventListener('keyup', (e) => {
        switch(e.key) {
            case 'ArrowUp':
            case 'z':
            case 'Z':
                keys.up = false;
                break;
            case 'ArrowDown':
            case 's':
            case 'S':
                keys.down = false;
                break;
            case 'ArrowLeft':
            case 'q':
            case 'Q':
                keys.left = false;
                break;
            case 'ArrowRight':
            case 'd':
            case 'D':
                keys.right = false;
                break;
        }
    });
}

function moveRat() {
    if (!rat) return;

    let moveX = 0;
    let moveZ = 0;

    if (keys.up) moveZ -= moveSpeed;
    if (keys.down) moveZ += moveSpeed;
    if (keys.left) moveX -= moveSpeed;
    if (keys.right) moveX += moveSpeed;

    if (moveX === 0 && moveZ === 0) return;

    const newX = rat.position.x + moveX;
    const newZ = rat.position.z + moveZ;

    let canMove = true;
    for (let obj of collisionObjects) {
        const objPos = new THREE.Vector3(obj.position.x, 0, obj.position.z);
        const newPos = new THREE.Vector3(newX, 0, newZ);
        if (objPos.distanceTo(newPos) < 1.2) {
            canMove = false;
            break;
        }
    }

    if (newX < -5.5 || newX > 5.5 || newZ < -5.5 || newZ > 5.5) {
        canMove = false;
    }
    if (canMove) {
        rat.position.x = newX;
        rat.position.z = newZ;

        if (moveX !== 0 || moveZ !== 0) {
            const angle = Math.atan2(moveX, moveZ);
            rat.rotation.y = angle;
        }
        checkCheeseCollection();
    }
    updateCamera();
}

function checkCheeseCollection() {
    if (!rat) return;

    for (let i = 0; i < cheese.length; i++) {
        if (cheese[i]) {
            const distance = Math.sqrt(
                Math.pow(rat.position.x - cheese[i].position.x, 2) +
                Math.pow(rat.position.z - cheese[i].position.z, 2)
            );

            if (distance < 0.7) {
                scene.remove(cheese[i].model);
                cheesePositions.splice(i, 1);
                cheese.splice(i, 1);
                cheeseCount++;
                document.getElementById('score').textContent = `Fromages collectés: ${cheeseCount}`;
                generateCheese();
                break;
            }
        }
    }
}

function updateCamera() {
    if (!rat) return;
    const offset = new THREE.Vector3(0, 8, 8);
    camera.position.copy(rat.position).add(offset);
    camera.lookAt(rat.position);
}

function onWindowResize() {
    camera.aspect = window.innerWidth / window.innerHeight;
    camera.updateProjectionMatrix();
    renderer.setSize(window.innerWidth, window.innerHeight);
}

function animate() {
    requestAnimationFrame(animate);
    moveRat();
    renderer.render(scene, camera);
}
init();
animate();


