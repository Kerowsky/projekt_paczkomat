<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body>
<main class="w-100">
    <div class="row">
        <header class="w-100 text-center">Control Panel</header>
    </div>
    <div class="container">
        <div class="row align-items-start">
            <div class="col">
                <h2 class="text-center">Open:</h2>
                <div class="pt-2 d-flex justify-content-evenly">
                    <button href="#" class="btn btn-primary" onclick="showModal()">Small locker</button>
                    <button href="#" class="btn btn-primary">Medium locker</button>
                    <button href="#" class="btn btn-primary">Large locker</button>
                </div>
            </div>
            <div class="col">
                <h2 class="text-center">Medical box info:</h2>
                <div class="pt-2 d-flex justify-content-evenly">
                    <div class="chart-container">
                        <canvas id="tempChart"></canvas>
                    </div>
                </div>
            </div>
        </div>
</main>
<script src="scripts/controlPanel.js" defer></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

<div class="modal fade" id="infoModal" tabindex="-1" aria-hidden="true" data-bs-backdrop="static">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content bg-dark">
            <div class="modal-body text-center text-white p-4">
                <h4 class="mb-4">Did you collect your parcel?</h4>
                <div class="d-flex justify-content-center gap-3">
                    <button type="button" class="btn btn-success btn-lg px-5" onclick="confirmYes()">YES</button>
                    <button type="button" class="btn btn-danger btn-lg px-5" onclick="confirmNo()">NO</button>
                </div>
                <button type="button" class="btn btn-secondary mt-4" data-bs-dismiss="modal">← BACK</button>
            </div>
        </div>
    </div>
</div>