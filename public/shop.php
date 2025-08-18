<link rel="stylesheet" href="css/shop.css">
<div class="bg-overlay"></div>
    
    <div class="container-gallery">
        <div class="header">
            <h1>SHOP</h1>
            <p>Descubre lo último en tecnología disponible en nuestra sucursal</p>
        </div>

        <div class="search-container-shop">
            <div class="search-icon-shop">🔍</div>
            <input type="text" class="search-input-shop" placeholder="Buscar productos..." id="searchInput-shop">
        </div>

        <div class="filters">
            <button class="filter-btn active" data-category="all">Todos</button>
            <button class="filter-btn" data-category="smartphones">Smartphones</button>
            <button class="filter-btn" data-category="laptops">Laptops</button>
            <button class="filter-btn" data-category="tablets">Tablets</button>
            <button class="filter-btn" data-category="accesorios">Accesorios</button>
            <button class="filter-btn" data-category="gaming">Gaming</button>
        </div>

        <div class="gallery" id="gallery">
            <!-- Smartphones -->
            <div class="product-card-gallery fade-in" data-category="smartphones">
                <div class="product-image-gallery">
                    <img src="https://images.unsplash.com/photo-1542291026-7eec264c27ff?w=400&h=300&fit=crop&crop=center"
                                alt="Sneakers" class="w-full h-full object-cover rounded-xl">
                </div>
                <div class="product-category-gallery">Smartphones</div>
                <div class="product-title-gallery">Galaxy S24 Ultra</div>
                <div class="product-specs-gallery">
                    <span class="spec-tag">256GB</span>
                    <span class="spec-tag">5G</span>
                    <span class="spec-tag">AI</span>
                </div>
                <div class="product-description-gallery">
                    El smartphone más avanzado con cámaras profesionales y rendimiento excepcional.
                </div>
                <div class="product-price-gallery">$1,299 <span style="font-size: 0.8rem; color: var(--c-gris-medio-main);">USD</span></div>
            </div>

            <div class="product-card-gallery fade-in" data-category="smartphones">
                <div class="product-image-gallery">
                    <img src="https://images.unsplash.com/photo-1523275335684-37898b6baf30?w=400&h=300&fit=crop&crop=center"
                                alt="Sunglasses" class="w-full h-full object-cover rounded-xl">
                </div>
                <div class="product-category-gallery">Smartphones</div>
                <div class="product-title-gallery">iPhone 15 Pro Max</div>
                <div class="product-specs-gallery">
                    <span class="spec-tag">512GB</span>
                    <span class="spec-tag">ProRAW</span>
                    <span class="spec-tag">Titanium</span>
                </div>
                <div class="product-description-gallery">
                    Innovación en cada detalle con el chip A17 Pro y cámara de acción revolucionaria.
                </div>
                <div class="product-price-gallery">$1,599 <span style="font-size: 0.8rem; color: var(--c-gris-medio-main);">USD</span></div>
            </div>

            <!-- Laptops -->
            <div class="product-card-gallery fade-in" data-category="laptops">
                <div class="product-image-gallery">
                    <img src="https://images.unsplash.com/photo-1546868871-7041f2a55e12?w=400&h=300&fit=crop&crop=center"
                                alt="Gaming Mouse" class="w-full h-full object-cover rounded-xl">
                </div>
                <div class="product-category-gallery">Laptops</div>
                <div class="product-title-gallery">MacBook Pro M3</div>
                <div class="product-specs-gallery">
                    <span class="spec-tag">16"</span>
                    <span class="spec-tag">32GB RAM</span>
                    <span class="spec-tag">1TB SSD</span>
                </div>
                <div class="product-description-gallery">
                    Potencia profesional con el chip M3, perfecto para creadores y desarrolladores.
                </div>
                <div class="product-price-gallery">$2,899 <span style="font-size: 0.8rem; color: var(--c-gris-medio-main);">USD</span></div>
            </div>

            <div class="product-card-gallery fade-in" data-category="laptops">
                <div class="product-image-gallery">
                     <img src="https://images.unsplash.com/photo-1434056886845-dac89ffe9b56?w=400&h=300&fit=crop&crop=center"
                            alt="Coffee Maker" class="w-full h-full object-cover rounded-xl">
                </div>
                <div class="product-category-gallery">Laptops</div>
                <div class="product-title-gallery">Dell XPS 13 Plus</div>
                <div class="product-specs-gallery">
                    <span class="spec-tag">13"</span>
                    <span class="spec-tag">Intel i7</span>
                    <span class="spec-tag">OLED</span>
                </div>
                <div class="product-description-gallery">
                    Diseño minimalista con pantalla OLED y rendimiento premium para profesionales.
                </div>
                <div class="product-price-gallery">$1,899 <span style="font-size: 0.8rem; color: var(--c-gris-medio-main);">USD</span></div>
            </div>

            <!-- Tablets -->
            <div class="product-card-gallery fade-in" data-category="tablets">
                <div class="product-image-gallery">
                    <img src="https://images.unsplash.com/photo-1484704849700-f032a568e944?w=400&h=300&fit=crop&crop=center"
                                alt="Tablet Pro" class="w-full h-full object-cover rounded-xl">
                </div>
                <div class="product-category-gallery">Tablets</div>
                <div class="product-title-gallery">iPad Pro M2</div>
                <div class="product-specs-gallery">
                    <span class="spec-tag">12.9"</span>
                    <span class="spec-tag">WiFi + 5G</span>
                    <span class="spec-tag">Apple Pencil</span>
                </div>
                <div class="product-description-gallery">
                    La tablet más poderosa con tecnología M2 y compatibilidad total con Apple Pencil.
                </div>
                <div class="product-price-gallery">$1,199 <span style="font-size: 0.8rem; color: var(--c-gris-medio-main);">USD</span></div>
            </div>

            <div class="product-card-gallery fade-in" data-category="tablets">
                <div class="product-image-gallery">
                    <img src="https://images.unsplash.com/photo-1527864550417-7fd91fc51a46?w=400&h=300&fit=crop&crop=center"
                                alt="Mechanical Keyboard" class="w-full h-full object-cover rounded-xl">
                </div>
                <div class="product-category-gallery">Tablets</div>
                <div class="product-title-gallery">Surface Pro 9</div>
                <div class="product-specs-gallery">
                    <span class="spec-tag">13"</span>
                    <span class="spec-tag">Intel i7</span>
                    <span class="spec-tag">2-in-1</span>
                </div>
                <div class="product-description-gallery">
                    Versatilidad máxima en un dispositivo 2-en-1 con Windows 11 y conectividad 5G.
                </div>
                <div class="product-price-gallery">$1,399 <span style="font-size: 0.8rem; color: var(--c-gris-medio-main);">USD</span></div>
            </div>

            <!-- Gaming -->
            <div class="product-card-gallery fade-in" data-category="gaming">
                <div class="product-image-gallery">
                    <img src="https://images.unsplash.com/photo-1546868871-7041f2a55e12?w=400&h=300&fit=crop&crop=center"
                                alt="Gaming Mouse" class="w-full h-full object-cover rounded-xl">
                </div>
                <div class="product-category-gallery">Gaming</div>
                <div class="product-title-gallery">Steam Deck OLED</div>
                <div class="product-specs-gallery">
                    <span class="spec-tag">7.4" OLED</span>
                    <span class="spec-tag">512GB</span>
                    <span class="spec-tag">Portable</span>
                </div>
                <div class="product-description-gallery">
                    Consola portátil con pantalla OLED y acceso completo a la biblioteca de Steam.
                </div>
                <div class="product-price-gallery">$649 <span style="font-size: 0.8rem; color: var(--c-gris-medio-main);">USD</span></div>
            </div>

            <div class="product-card-gallery fade-in" data-category="gaming">
                <div class="product-image-gallery">
                    <img src="https://images.unsplash.com/photo-1560472354-b33ff0c44a43?w=400&h=300&fit=crop&crop=center"
                                alt="VR Headset" class="w-full h-full object-cover rounded-xl">
                </div>
                <div class="product-category-gallery">Gaming</div>
                <div class="product-title-gallery">ROG Ally Extreme</div>
                <div class="product-specs-gallery">
                    <span class="spec-tag">AMD Z1</span>
                    <span class="spec-tag">16GB RAM</span>
                    <span class="spec-tag">120Hz</span>
                </div>
                <div class="product-description-gallery">
                    Handheld gaming con Windows 11 y compatibilidad total con Game Pass y Steam.
                </div>
                <div class="product-price-gallery">$799 <span style="font-size: 0.8rem; color: var(--c-gris-medio-main);">USD</span></div>
            </div>

            <!-- Accesorios -->
            <div class="product-card-gallery fade-in" data-category="accesorios">
                <div class="product-image-gallery">
                    <img src="https://images.unsplash.com/photo-1572635196237-14b3f281503f?w=400&h=300&fit=crop&crop=center"
                                alt="Smart Watch" class="w-full h-full object-cover rounded-xl">
                </div>
                <div class="product-category-gallery">Accesorios</div>
                <div class="product-title-gallery">AirPods Pro 2</div>
                <div class="product-specs-gallery">
                    <span class="spec-tag">USB-C</span>
                    <span class="spec-tag">ANC</span>
                    <span class="spec-tag">Spatial Audio</span>
                </div>
                <div class="product-description-gallery">
                    Auriculares inalámbricos con cancelación de ruido adaptativa y audio espacial.
                </div>
                <div class="product-price-gallery">$249 <span style="font-size: 0.8rem; color: var(--c-gris-medio-main);">USD</span></div>
            </div>

            <div class="product-card-gallery fade-in" data-category="accesorios">
                <div class="product-image-gallery">
                    <img src="https://images.unsplash.com/photo-1484704849700-f032a568e944?w=400&h=300&fit=crop&crop=center"
                                alt="Tablet Pro" class="w-full h-full object-cover rounded-xl">
                </div>
                <div class="product-category-gallery">Accesorios</div>
                <div class="product-title-gallery">MagSafe Charger</div>
                <div class="product-specs-gallery">
                    <span class="spec-tag">15W</span>
                    <span class="spec-tag">MagSafe</span>
                    <span class="spec-tag">Qi2</span>
                </div>
                <div class="product-description-gallery">
                    Carga inalámbrica magnética rápida y precisa para dispositivos compatibles.
                </div>
                <div class="product-price-gallery">$39 <span style="font-size: 0.8rem; color: var(--c-gris-medio-main);">USD</span></div>
            </div>
        </div>
    </div>
    <script src="js/shop.js"></script>