// resources/js/admin.js - Admin Panel Only

import './bootstrap';
import './bundle';
import './fix-debugger';

// === TailAdmin + Alpine.js ===
import Alpine from 'alpinejs';
import persist from '@alpinejs/persist';

Alpine.plugin(persist);

window.Alpine = Alpine;
Alpine.start();

// Tambahkan kode custom admin di sini jika perlu
document.addEventListener('alpine:init', () => {
    console.log('Alpine.js + Admin Panel siap');
});
