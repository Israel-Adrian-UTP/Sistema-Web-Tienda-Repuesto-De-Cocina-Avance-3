
//BOTON SUBIR ARRIBA
const btnVolverArriba = document.getElementById('btnVolverArriba');
if (btnVolverArriba) {
    window.addEventListener('scroll', function () {
        btnVolverArriba.style.display = window.scrollY > 200 ? 'block' : 'none';
    });
    btnVolverArriba.addEventListener('click', function () {
        window.scrollTo({ top: 0, behavior: 'smooth' });
    });
}
//MODO OSCURO
document.addEventListener('DOMContentLoaded', function () {
    const btn = document.getElementById('btnModoOscuro');
    if (!btn) return;
    function aplicarModo(oscuro) {
        document.body.classList.toggle('modo-oscuro', oscuro);
        btn.textContent = oscuro ? '☀️' : '🌙';
        btn.title = oscuro ? 'Modo claro' : 'Modo oscuro';
    }
    let oscuro = false;
    try { oscuro = localStorage.getItem('modoOscuro') === '1'; } catch (e) {}
    aplicarModo(oscuro);
    btn.addEventListener('click', function () {
        oscuro = !document.body.classList.contains('modo-oscuro');
        aplicarModo(oscuro);
        try { localStorage.setItem('modoOscuro', oscuro ? '1' : '0'); } catch (e) {}
    });
});
//BUSCADOR
const productosCatalogo = [
    [1, "COCINA DE MESA 2 HORNILLAS", "S/ 49.90"],
    [2, "RON DE QUEMAR", "S/ 4.90"],
    [3, "MANGUERA DE ALTA PRESION 1.5 METROS + REGULADOR ALTA PRESION", "S/ 39.90"],
    [4, "MANGUERA DE BAJA PRESION 1.5 METROS + REGULADOR BAJA PRESION", "S/ 39.90"],
    [5, "QUEMADOR + TAPA DE BRONCE COCINA INDURAMA", "S/ 119.90"],
    [6, "TAPAS DE COCINA MABE", "S/ 79.90"],
    [7, "CUCHILLA PICA HIELO", "S/ 29.90"],
    [8, "QUEMADOR INDUSTRIAL", "S/ 24.90"],
    [9, "REGULADOR DE BAJA PRESION", "S/ 29.90"],
    [10, "REGULADOR DE ALTA PRESION", "S/ 19.90"],
    [11, "MANGUERA DE GAS NATURAL 1.5 METROS", "S/ 29.90"]
];
const idsPaquetes = [3, 4, 5, 6];
const catalogo = productosCatalogo
    .map(function (p) {
        return { id: p[0], nombre: p[1], precio: p[2], tipo: 'Producto', pagina: 'producto.php' };
    })
    .concat(productosCatalogo
        .filter(function (p) { return idsPaquetes.includes(p[0]); })
        .map(function (p) {
            return { id: p[0], nombre: p[1], precio: p[2], tipo: 'Paquete', pagina: 'paquetes.php' };
        }));
function normalizar(texto) {
    return texto.normalize('NFD').replace(/[\u0300-\u036f]/g, '').toLowerCase();
}
document.addEventListener('DOMContentLoaded', function () {
    const searchForm = document.querySelector('.search-bar form');
    if (!searchForm) return;
    const searchInput = searchForm.querySelector('input');
    searchInput.setAttribute('autocomplete', 'off');
    const panel = document.createElement('div');
    panel.className = 'search-results';
    searchForm.appendChild(panel);
    function cerrar() {
        panel.classList.remove('abierto');
        panel.innerHTML = '';
    }
    function buscar() {
        const terminos = normalizar(searchInput.value).split(/\s+/).filter(Boolean);
        if (terminos.length === 0) { cerrar(); return; }
        const resultados = catalogo.filter(function (item) {
            const texto = normalizar(item.nombre + ' ' + item.tipo);
            return terminos.every(function (t) { return texto.includes(t); });
        });
        panel.innerHTML = '';
        if (resultados.length === 0) {
            const vacio = document.createElement('div');
            vacio.className = 'sin-resultados';
            vacio.textContent = 'No se encontraron repuestos para "' + searchInput.value.trim() + '".';
            panel.appendChild(vacio);
        } else {
            resultados.forEach(function (item) {
                const a = document.createElement('a');
                a.href = item.pagina + '#producto-' + item.id;
                const img = document.createElement('img');
                img.src = 'img/' + item.id + '.jpeg';
                img.alt = '';
                const info = document.createElement('span');
                info.className = 'info';
                const nombre = document.createElement('b');
                nombre.textContent = item.nombre;
                const detalle = document.createElement('small');
                detalle.textContent = item.tipo + ' · ' + item.precio;
                info.appendChild(nombre);
                info.appendChild(detalle);
                a.appendChild(img);
                a.appendChild(info);
                panel.appendChild(a);
            });
        }
        panel.classList.add('abierto');
    }
    searchInput.addEventListener('input', buscar);
    searchInput.addEventListener('focus', buscar);
    searchForm.addEventListener('submit', function (e) {
        e.preventDefault();
        buscar();
    });
    document.addEventListener('click', function (e) {
        if (!searchForm.contains(e.target)) cerrar();
    });
    document.addEventListener('keydown', function (e) {
        if (e.key === 'Escape') cerrar();
    });
});
function resaltarProducto() {
    if (!/^#producto-\d+$/.test(location.hash)) return;
    const tarjeta = document.querySelector(location.hash);
    if (!tarjeta) return;
    document.querySelectorAll('.resaltado').forEach(function (el) { el.classList.remove('resaltado'); });
    tarjeta.scrollIntoView({ behavior: 'smooth', block: 'center' });
    // reinicia la animacion si ya estaba aplicada
    void tarjeta.offsetWidth;
    tarjeta.classList.add('resaltado');
    setTimeout(function () { tarjeta.classList.remove('resaltado'); }, 3500);
}
document.addEventListener('DOMContentLoaded', resaltarProducto);
window.addEventListener('hashchange', resaltarProducto);
