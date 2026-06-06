
// 1. Filter kategori

function filterCategory(slug) {
    document.querySelectorAll('.filter-btn').forEach(btn => btn.classList.remove('active-filter'));
    document.querySelector('[data-cat="' + slug + '"]').classList.add('active-filter');
    document.querySelectorAll('.category-section').forEach(section => {
        section.classList.toggle('hidden-cat', slug !== 'all' && section.dataset.category !== slug);
    });
}

// 2. DearFlip Flipbook

var dfBookInstance = null;

function openDearFlip(title, fileUrl) {
    var overlay  = document.getElementById('df-overlay');
    var titleEl  = document.getElementById('df-title');
    var loading  = document.getElementById('df-loading');
    var nofile   = document.getElementById('df-nofile');
    var bookWrap = document.getElementById('df-book-wrap');
    var bookEl   = document.getElementById('df-flipbook');

    titleEl.textContent          = title;
    loading.style.display        = 'flex';
    nofile.style.display         = 'none';
    bookWrap.style.display       = 'none';
    overlay.classList.add('df-active');
    document.body.style.overflow = 'hidden';

    if (!fileUrl) {
        loading.style.display = 'none';
        nofile.style.display  = 'flex';
        return;
    }

    if (dfBookInstance) {
        try { dfBookInstance.dispose(); } catch(e) {}
        dfBookInstance = null;
    }

    bookEl.innerHTML       = '';
    bookWrap.style.display = 'block';
    loading.style.display  = 'none';

    dfBookInstance = $(bookEl).flipBook(fileUrl, {
        height              : '72vh',
        duration            : 800,
        scale               : 1.5,
        webgl               : false,
        autoEnableOutline   : false,
        autoEnableThumbnail : false,
        controlsPosition    : 'bottom',
        onReady : function() { loading.style.display = 'none'; },
        onError : function() {
            loading.style.display  = 'none';
            nofile.style.display   = 'flex';
            bookWrap.style.display = 'none';
        },
    });
}

function closeDearFlip() {
    var overlay  = document.getElementById('df-overlay');
    var bookEl   = document.getElementById('df-flipbook');
    var bookWrap = document.getElementById('df-book-wrap');
    var loading  = document.getElementById('df-loading');
    var nofile   = document.getElementById('df-nofile');

    overlay.classList.remove('df-active');
    document.body.style.overflow = '';

    if (dfBookInstance) {
        try { dfBookInstance.dispose(); } catch(e) {}
        dfBookInstance = null;
    }

    bookEl.innerHTML       = '';
    bookWrap.style.display = 'none';
    loading.style.display  = 'none';
    nofile.style.display   = 'none';
}

// Klik backdrop → tutup flipbook
document.getElementById('df-overlay').addEventListener('click', function(e) {
    if (e.target === this) closeDearFlip();
});
