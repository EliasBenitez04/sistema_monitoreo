/*
 * Sistema Monitoreo — UI Enhancements V3
 * Progressive enhancement only: no business logic is changed here.
 */

(function () {
    'use strict';

    function onReady(callback) {
        if (document.readyState === 'loading') {
            document.addEventListener('DOMContentLoaded', callback, { once: true });
        } else {
            callback();
        }
    }

    function normalize(value) {
        return (value || '')
            .normalize('NFD')
            .replace(/[\u0300-\u036f]/g, '')
            .toLowerCase()
            .trim();
    }

    function enhanceCards() {
        document.querySelectorAll('.card').forEach(function (card) {
            card.classList.add('sm-enhanced-card');

            if (card.querySelector('table')) {
                card.classList.add('sm-data-card');
            }

            if (card.querySelector('form') && !card.querySelector('table')) {
                card.classList.add('sm-form-card');
            }
        });
    }

    function enhanceTables(root) {
        (root || document).querySelectorAll('table.table').forEach(function (table) {
            table.classList.add('sm-table', 'table-hover');

            var rows = table.querySelectorAll('tbody tr').length;
            if (rows >= 8) {
                table.classList.add('sm-sticky-head');
            }

            var parent = table.parentElement;
            if (parent && !parent.classList.contains('table-responsive')) {
                var cardBody = table.closest('.card-body');
                if (cardBody && table.scrollWidth > cardBody.clientWidth) {
                    var wrapper = document.createElement('div');
                    wrapper.className = 'table-responsive';
                    table.parentNode.insertBefore(wrapper, table);
                    wrapper.appendChild(table);
                }
            }
        });
    }

    function enhanceForms() {
        document.querySelectorAll('form').forEach(function (form) {
            var isGet = (form.getAttribute('method') || 'GET').toUpperCase() === 'GET';
            var hasSearch = form.querySelector('input[type="search"], input[name="buscar"], input[name="search"], .buscar');
            var hasFilters = form.querySelectorAll('select').length >= 2;

            if ((isGet && (hasSearch || hasFilters)) || form.classList.contains('filter-form')) {
                form.classList.add('sm-filter-form');
            }

            form.querySelectorAll('.input-group').forEach(function (group) {
                if (group.querySelector('input[name="buscar"], input[name="search"], input[type="search"]')) {
                    group.classList.add('sm-search-group');
                }
            });
        });
    }

    var buttonIconMap = [
        { pattern: /^(nuevo|nueva|agregar|crear)/i, icon: 'fas fa-plus' },
        { pattern: /^(guardar|registrar)/i, icon: 'fas fa-check' },
        { pattern: /^(cancelar|volver|regresar)/i, icon: 'fas fa-arrow-left' },
        { pattern: /^(buscar|consultar)/i, icon: 'fas fa-search' },
        { pattern: /^(editar|modificar)/i, icon: 'fas fa-pen' },
        { pattern: /^(eliminar|borrar)/i, icon: 'fas fa-trash-alt' },
        { pattern: /^(importar|cargar)/i, icon: 'fas fa-file-import' },
        { pattern: /^(exportar|descargar)/i, icon: 'fas fa-download' },
        { pattern: /^(imprimir)/i, icon: 'fas fa-print' },
        { pattern: /^(analizar|ejecutar)/i, icon: 'fas fa-play' },
        { pattern: /^(actualizar|refrescar)/i, icon: 'fas fa-sync-alt' }
    ];

    function enhanceButtons(root) {
        (root || document).querySelectorAll('a.btn, button.btn').forEach(function (button) {
            if (button.querySelector('i, svg')) {
                return;
            }

            var label = (button.textContent || '').replace(/\s+/g, ' ').trim();
            if (!label) {
                button.classList.add('sm-icon-button');
                return;
            }

            var match = buttonIconMap.find(function (item) {
                return item.pattern.test(label);
            });

            if (match) {
                var icon = document.createElement('i');
                icon.className = match.icon;
                icon.setAttribute('aria-hidden', 'true');
                button.insertBefore(icon, button.firstChild);
            }
        });
    }

    function enhancePageHeaders() {
        document.querySelectorAll('.content-header').forEach(function (header) {
            header.classList.add('sm-page-heading');
        });
    }

    function setupSidebarSearch() {
        var input = document.getElementById('sm-menu-search');
        var menu = document.querySelector('.nav-sidebar');
        var empty = document.getElementById('sm-menu-search-empty');

        if (!input || !menu) {
            return;
        }

        var topItems = Array.prototype.slice.call(menu.children).filter(function (node) {
            return node.classList && node.classList.contains('nav-item');
        });

        var headers = Array.prototype.slice.call(menu.children).filter(function (node) {
            return node.classList && node.classList.contains('nav-header');
        });

        topItems.forEach(function (item) {
            item.dataset.smInitiallyOpen = item.classList.contains('menu-open') ? '1' : '0';
        });

        function resetMenu() {
            topItems.forEach(function (item) {
                item.classList.remove('sm-menu-hidden');
                item.querySelectorAll('.nav-item').forEach(function (child) {
                    child.classList.remove('sm-menu-hidden');
                });

                if (item.dataset.smInitiallyOpen === '1') {
                    item.classList.add('menu-open');
                } else {
                    item.classList.remove('menu-open');
                }
            });

            headers.forEach(function (header) {
                header.classList.remove('sm-menu-hidden');
            });

            if (empty) {
                empty.classList.remove('is-visible');
            }
        }

        function filterMenu() {
            var query = normalize(input.value);
            if (!query) {
                resetMenu();
                return;
            }

            var visibleCount = 0;

            topItems.forEach(function (item) {
                var directLink = item.querySelector(':scope > .nav-link');
                var children = Array.prototype.slice.call(item.querySelectorAll('.nav-treeview > .nav-item'));
                var directMatch = directLink && normalize(directLink.textContent).indexOf(query) !== -1;
                var childMatchCount = 0;

                children.forEach(function (child) {
                    var matches = normalize(child.textContent).indexOf(query) !== -1;
                    child.classList.toggle('sm-menu-hidden', !matches && !directMatch);
                    if (matches) {
                        childMatchCount += 1;
                    }
                });

                var matchesItem = directMatch || childMatchCount > 0 || normalize(item.textContent).indexOf(query) !== -1;
                item.classList.toggle('sm-menu-hidden', !matchesItem);

                if (matchesItem) {
                    visibleCount += 1;
                    if (children.length) {
                        item.classList.add('menu-open');
                    }
                }
            });

            headers.forEach(function (header) {
                var next = header.nextElementSibling;
                var hasVisibleGroup = false;

                while (next && !next.classList.contains('nav-header')) {
                    if (next.classList.contains('nav-item') && !next.classList.contains('sm-menu-hidden')) {
                        hasVisibleGroup = true;
                        break;
                    }
                    next = next.nextElementSibling;
                }

                header.classList.toggle('sm-menu-hidden', !hasVisibleGroup);
            });

            if (empty) {
                empty.classList.toggle('is-visible', visibleCount === 0);
            }
        }

        input.addEventListener('input', filterMenu);

        document.addEventListener('keydown', function (event) {
            var target = event.target;
            var isTyping = target && (target.matches('input, textarea, select') || target.isContentEditable);

            if ((event.ctrlKey || event.metaKey) && event.key.toLowerCase() === 'k') {
                event.preventDefault();
                input.focus();
                input.select();
                return;
            }

            if (event.key === 'Escape' && document.activeElement === input) {
                input.value = '';
                resetMenu();
                input.blur();
            }

            if (!isTyping && event.key === '/') {
                event.preventDefault();
                input.focus();
            }
        });
    }

    function setupScrollTop() {
        var button = document.createElement('button');
        button.type = 'button';
        button.className = 'sm-scroll-top';
        button.setAttribute('aria-label', 'Volver arriba');
        button.title = 'Volver arriba';
        button.innerHTML = '<i class="fas fa-arrow-up" aria-hidden="true"></i>';
        document.body.appendChild(button);

        function updateVisibility() {
            button.classList.toggle('is-visible', window.scrollY > 420);
        }

        window.addEventListener('scroll', updateVisibility, { passive: true });
        updateVisibility();

        button.addEventListener('click', function () {
            window.scrollTo({ top: 0, behavior: 'smooth' });
        });
    }

    function observeAjaxContent() {
        var observer = new MutationObserver(function (mutations) {
            mutations.forEach(function (mutation) {
                mutation.addedNodes.forEach(function (node) {
                    if (!(node instanceof HTMLElement)) {
                        return;
                    }

                    enhanceTables(node);
                    enhanceButtons(node);
                });
            });
        });

        observer.observe(document.body, {
            childList: true,
            subtree: true
        });
    }

    onReady(function () {
        document.body.classList.add('sm-ui-v3');
        enhancePageHeaders();
        enhanceCards();
        enhanceTables(document);
        enhanceForms();
        enhanceButtons(document);
        setupSidebarSearch();
        setupScrollTop();
        observeAjaxContent();
    });
})();
