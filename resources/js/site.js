// Mobile menu toggle
(function () {
    var menuToggle = document.querySelector('.mobile-menu-toggle');
    var navMenu = document.querySelector('.nav-menu');
    if (menuToggle && navMenu) {
        menuToggle.addEventListener('click', function () {
            navMenu.classList.toggle('active');
        });
    }
}());

// Language switcher
(function () {
    var languageSwitcher = document.querySelector('.language-switcher');
    var languageCurrent = document.getElementById('languageCurrent');
    var languageDropdown = document.getElementById('languageDropdown');
    
    // Sayfa yüklendiğinde dropdown'u kesinlikle gizle
    if (languageDropdown) {
        languageDropdown.style.display = 'none';
        languageDropdown.style.opacity = '0';
        languageDropdown.style.visibility = 'hidden';
    }
    
    if (languageSwitcher && languageCurrent) {
        languageCurrent.addEventListener('click', function (e) {
            e.stopPropagation();
            e.preventDefault();
            
            var isActive = languageSwitcher.classList.contains('active');
            
            if (isActive) {
                // Kapat
                languageSwitcher.classList.remove('active');
                if (languageDropdown) {
                    languageDropdown.style.display = 'none';
                    languageDropdown.style.opacity = '0';
                    languageDropdown.style.visibility = 'hidden';
                }
            } else {
                // Aç
                languageSwitcher.classList.add('active');
                if (languageDropdown) {
                    languageDropdown.style.display = 'block';
                    languageDropdown.style.opacity = '1';
                    languageDropdown.style.visibility = 'visible';
                }
            }
        });
        
        // Dışarı tıklandığında kapat
        document.addEventListener('click', function (e) {
            if (languageSwitcher && !languageSwitcher.contains(e.target)) {
                languageSwitcher.classList.remove('active');
                if (languageDropdown) {
                    languageDropdown.style.display = 'none';
                    languageDropdown.style.opacity = '0';
                    languageDropdown.style.visibility = 'hidden';
                }
            }
        });
    }
}());

// Dünya haritası ülke tıklama - Blade'deki script ile yönetiliyor

// Instagram native embed
(function () {
    var urls = window.INSTAGRAM_POST_URLS;
    if (!urls || !urls.length) return;
    var grid = document.getElementById('instagram-feed');
    if (!grid) return;
    for (var i = 0; i < urls.length; i++) {
        var wrap = document.createElement('div');
        wrap.className = 'instagram-item';
        var bq = document.createElement('blockquote');
        bq.className = 'instagram-media';
        bq.setAttribute('data-instgrm-permalink', urls[i]);
        bq.setAttribute('data-instgrm-captioned', '');
        wrap.appendChild(bq);
        grid.appendChild(wrap);
    }
    var s = document.createElement('script');
    s.async = true;
    s.src = 'https://www.instagram.com/embed.js';
    s.onload = function () {
        if (window.instgrm && window.instgrm.Embeds) window.instgrm.Embeds.process();
    };
    document.body.appendChild(s);
}());

// Header sticky davranışı - Scroll yapıldığında sabit kalır
(function () {
    function initStickyHeader() {
        var header = document.querySelector('.header');
        if (!header) {
            return;
        }
        
        var scrollThreshold = 50;
        var headerHeight = 0;
        var isSticky = false;
        
        // Header yüksekliğini hesapla
        function updateHeaderHeight() {
            headerHeight = header.offsetHeight;
        }
        
        function setBodyPadding() {
            if (isSticky && headerHeight > 0) {
                document.body.style.paddingTop = headerHeight + 'px';
                document.body.classList.add('has-sticky-header');
            } else {
                document.body.style.paddingTop = '0';
                document.body.classList.remove('has-sticky-header');
            }
        }
        
        function handleScroll() {
            var scrollTop = window.pageYOffset || document.documentElement.scrollTop;
            
            if (scrollTop > scrollThreshold) {
                if (!isSticky) {
                    updateHeaderHeight();
                    header.classList.add('sticky');
                    isSticky = true;
                    setBodyPadding();
                }
            } else {
                if (isSticky) {
                    header.classList.remove('sticky');
                    isSticky = false;
                    setBodyPadding();
                }
            }
        }
        
        // Resize'da header yüksekliğini güncelle
        function handleResize() {
            updateHeaderHeight();
            if (isSticky) {
                setBodyPadding();
            }
        }
        
        // Throttle için requestAnimationFrame kullan
        var ticking = false;
        function onScroll() {
            if (!ticking) {
                window.requestAnimationFrame(function() {
                    handleScroll();
                    ticking = false;
                });
                ticking = true;
            }
        }
        
        // İlk yüklemede header yüksekliğini hesapla
        updateHeaderHeight();
        
        window.addEventListener('scroll', onScroll, { passive: true });
        window.addEventListener('resize', handleResize);
        
        // İlk yüklemede kontrol et
        setTimeout(function() {
            handleScroll();
        }, 100);
    }
    
    // DOM yüklendiğinde çalıştır
    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', initStickyHeader);
    } else {
        initStickyHeader();
    }
}());
