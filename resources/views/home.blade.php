<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Skyrose Atelier</title>
    @include('partials.head')
    <style>
        .Hero {
            background: linear-gradient(135deg, rgba(200, 195, 137, 0.08) 0%, rgba(212, 175, 55, 0.05) 100%);
            position: relative;
            overflow: hidden;
        }
        .Hero::before {
            content: '';
            position: absolute;
            top: 0;
            right: -100px;
            width: 500px;
            height: 500px;
            background: radial-gradient(circle, rgba(212, 175, 55, 0.1) 0%, transparent 70%);
            pointer-events: none;
        }
        .HeroInner { position: relative; z-index: 1; }
        .HeroCopy h1 {
            font-size: 56px;
            font-weight: 700;
            line-height: 1.1;
            color: #1a1a1a;
            margin: 0 0 20px 0;
            letter-spacing: -0.5px;
        }
        .HeroCopy p {
            font-size: 18px;
            line-height: 1.7;
            color: #555;
            max-width: 550px;
            margin-bottom: 35px;
        }
        .HeroCTA { display: flex; gap: 16px; align-items: center; }
        .BtnPrimary {
            background: #111;
            color: white;
            padding: 16px 40px;
            border: none;
            border-radius: 4px;
            font-size: 16px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
        }
        .BtnPrimary:hover {
            background: #333;
            transform: translateY(-2px);
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.2);
        }
        .BtnGhost {
            background: transparent;
            color: #111;
            padding: 16px 40px;
            border: 2px solid #111;
            border-radius: 4px;
            font-size: 16px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
        }
        .BtnGhost:hover { background: #111; color: white; }
        .HeroVisual {
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.12);
            transition: transform 0.5s ease;
        }
        .HeroVisual:hover { transform: translateY(-8px); }
        .HeroVisual img { width: 100%; height: auto; display: block; }
        .FeaturedCrafts { background: #fff; padding: 80px 24px; margin-top: 0; }
        .FeaturedCraftsTitle {
            font-size: 36px;
            font-weight: 700;
            color: #1a1a1a;
            text-align: center;
            margin: 0 0 60px 0;
            letter-spacing: -0.5px;
        }
        .FeaturedCraftsImgs {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
            gap: 40px;
            max-width: 1200px;
            margin: 0 auto;
        }
        .FeaturedCraftsImgs > div {
            text-align: center;
            cursor: pointer;
            transition: all 0.3s ease;
        }
        .FeaturedCraftsImgs > div:hover { transform: translateY(-8px); }
        .FeaturedCraftsImgs > div h3 {
            font-size: 18px;
            font-weight: 600;
            color: #111;
            margin-top: 16px;
            margin-bottom: 0;
        }
        .FeaturedItem {
            width: 100%;
            height: auto;
            border-radius: 8px;
            object-fit: cover;
            aspect-ratio: 1;
            box-shadow: 0 8px 24px rgba(0, 0, 0, 0.08);
            transition: all 0.3s ease;
        }
        .FeaturedItem:hover {
            box-shadow: 0 12px 32px rgba(0, 0, 0, 0.15);
            transform: scale(1.02);
        }
        @media (max-width: 900px) {
            .HeroInner { flex-direction: column; padding: 60px 20px; }
            .HeroVisual { max-width: 100%; width: 100%; }
            .HeroCopy h1 { font-size: 40px; }
            .FeaturedCraftsImgs { grid-template-columns: 1fr; gap: 30px; }
            .FeaturedCrafts { padding: 60px 20px; }
        }
        @media (max-width: 600px) {
            .HeroCopy h1 { font-size: 32px; }
            .HeroCopy p { font-size: 16px; }
            .HeroCTA { flex-direction: column; width: 100%; }
            .BtnPrimary, .BtnGhost { width: 100%; text-align: center; }
        }
    </style>
</head>
<body>
    <div class="page-wrapper">
        <div class="PageContent">
            @include('partials.nav')

            <main>
                <section class="Hero" aria-label="Hero">
                    <div class="HeroInner">
                        <div class="HeroCopy">
                            <h1 class="HeroTitle">Timeless Jewellery, Crafted to Last</h1>
                            <p class="HeroSubtitle">Discover handcrafted pieces made with ethically sourced materials. From everyday elegance to statement heirlooms find something to cherish.</p>
                            <div class="HeroCTA">
                                <a href="/products" style="text-decoration:none;"><button class="BtnPrimary">Shop Collection</button></a>
                                <a href="/about" style="text-decoration:none;"><button class="BtnGhost">Our Story</button></a>
                            </div>
                        </div>
                        <div class="HeroVisual">
                            <img src="{{ asset('images/LandingPageImage.png') }}" alt="Luxury jewelry collection">
                        </div>
                    </div>
                </section>

                <section class="FeaturedCrafts" aria-label="Featured crafts">
                    <h2 class="FeaturedCraftsTitle">Featured Crafts</h2>
                    <div class="FeaturedCraftsImgs">
                        <div>
                            <a href="/products?product=bleeding-heart-bracelet" data-name="Bleeding Heart Bracelet" data-category="Bracelet">
                            <img class="FeaturedItem" src="{{ asset('images/BleedingHeartBracelet.png') }}" alt="Bleeding Heart Bracelet">
                            <h3>Bleeding Heart Bracelet</h3>
                            </a>
                        </div>
                        <div>
                            <a href="/products?product=buta-ring" data-name="Buta Ring" data-category="Ring">
                            <img class="FeaturedItem" src="{{ asset('images/ButaRing.png') }}" alt="Buta Ring">
                            <h3>Buta Ring</h3>
                            </a>
                        </div>
                        <div>
                            <a href="/products?product=threadbare-earrings" data-name="Threadbare Earrings" data-category="Earrings">
                            <img class="FeaturedItem" src="{{ asset('images/ThreadbareEarrings.png') }}" alt="Threadbare Earrings">
                            <h3>Threadbare Earrings</h3>
                            </a>
                        </div>
                    </div>
                </section>
            </main>
        </div>

        @include('partials.footer')
    </div>
</body>
</html>


