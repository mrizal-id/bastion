<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Brand Projects & Portfolios</title>

    <!-- Bootstrap CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        .portfolio-img {
            width: 100%;
            height: 180px;
            object-fit: cover;
        }
    </style>
</head>

<body class="bg-light">

    <div class="container py-5">
        <h1 class="mb-4">Brand Projects & Portfolios</h1>

        <!-- Search -->
        <div class="input-group mb-4">
            <input type="text" id="query" class="form-control" placeholder="Slug / Nama Brand">
            <button class="btn btn-primary" onclick="loadBrand()">Cari</button>
        </div>

        <!-- Brand Info -->
        <div id="brand-info" class="mb-5"></div>

        <!-- Projects -->
        <div id="projects"></div>
    </div>

    <script>
        async function loadBrand() {
            const q = document.getElementById('query').value;
            if (!q) return alert('Query wajib diisi');

            const res = await fetch(`/api/v1/brand?q=${q}`);
            const json = await res.json();

            if (!res.ok) {
                alert(json.message ?? 'Error');
                return;
            }

            renderBrand(json.data);
        }

        function renderBrand(brand) {
            // Brand info
            document.getElementById('brand-info').innerHTML = `
        <div class="card">
            <div class="card-body">
                <h3>${brand.name}</h3>
                <p class="text-muted">${brand.slug}</p>
            </div>
        </div>
    `;

            let projectHtml = '';

            brand.projects.forEach(project => {
                if (!project.portfolios || project.portfolios.length === 0) return;

                let portfolioHtml = '';

                project.portfolios.forEach(portfolio => {
                    const thumb = portfolio.thumbnail ?
                        portfolio.thumbnail.url :
                        'https://via.placeholder.com/400x300';

                    portfolioHtml += `
                <div class="col-md-4 mb-4">
                    <div class="card h-100">
                        <img src="${thumb}" class="portfolio-img">
                        <div class="card-body">
                            <h6>${portfolio.title}</h6>
                            <span class="badge bg-secondary">
                                ${portfolio.category ?? '-'}
                            </span>
                        </div>
                    </div>
                </div>
            `;
                });

                projectHtml += `
            <div class="mb-5">
                <h4 class="mb-3">${project.name}</h4>
                <div class="row">
                    ${portfolioHtml}
                </div>
            </div>
        `;
            });

            document.getElementById('projects').innerHTML = projectHtml;
        }
    </script>

</body>

</html>