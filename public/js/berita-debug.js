// Debug script untuk modal berita
console.log('Berita debug script loaded');

// Fungsi showBeritaDetail yang menampilkan konten berita asli
window.showBeritaDetail = async function(index) {
    const berita = window.beritaData[index];
    if (!berita) return;

    const modal = document.getElementById('berita-modal');
    const modalContent = document.getElementById('berita-modal-content');
    modalContent.innerHTML = `
        <div class="text-center py-8">
            <div class="loading-dots">
                <span></span>
                <span></span>
                <span></span>
            </div>
            <p class="text-gray-600 mt-4">Memuat berita...</p>
        </div>
    `;
    modal.classList.remove('hidden');
    try {
        const response = await fetch(`/api/berita-content?url=${encodeURIComponent(berita.link)}`);
        const data = await response.json();
        if (data.success && data.content) {
            modalContent.innerHTML = `
                <div class="berita-detail">
                    <h2 class="text-2xl font-bold text-green-800 mb-4">${berita.judul}</h2>
                    <p class="text-sm text-gray-500 mb-4">${berita.tanggal || ''}</p>
                    <div class="prose max-w-none">
                        ${data.content}
                    </div>
                    <div class="mt-6 pt-4 border-t border-gray-200">
                        <p class="text-sm text-gray-600">Sumber: <a href="${berita.link}" target="_blank" class="text-green-600 hover:underline">DLHT Papua Barat</a></p>
                    </div>
                </div>
            `;
        } else {
            modalContent.innerHTML = `
                <div class="berita-detail">
                    <h2 class="text-2xl font-bold text-green-800 mb-4">${berita.judul}</h2>
                    <p class="text-sm text-gray-500 mb-4">${berita.tanggal || ''}</p>
                    <div class="prose max-w-none">
                        <p class="text-gray-700 mb-4">${berita.ringkasan}</p>
                        <p class="text-gray-600">Untuk membaca berita lengkap, silakan kunjungi:</p>
                        <a href="${berita.link}" target="_blank" class="text-green-600 hover:underline font-semibold">${berita.link}</a>
                    </div>
                    <div class="mt-6 pt-4 border-t border-gray-200">
                        <p class="text-sm text-gray-600">Sumber: DLHT Papua Barat</p>
                    </div>
                </div>
            `;
        }
    } catch (error) {
        modalContent.innerHTML = `
            <div class="berita-detail">
                <h2 class="text-2xl font-bold text-green-800 mb-4">${berita.judul}</h2>
                <p class="text-sm text-gray-500 mb-4">${berita.tanggal || ''}</p>
                <div class="prose max-w-none">
                    <p class="text-gray-700 mb-4">${berita.ringkasan}</p>
                    <p class="text-gray-600">Untuk membaca berita lengkap, silakan kunjungi:</p>
                    <a href="${berita.link}" target="_blank" class="text-green-600 hover:underline font-semibold">${berita.link}</a>
                </div>
                <div class="mt-6 pt-4 border-t border-gray-200">
                    <p class="text-sm text-gray-600">Sumber: DLHT Papua Barat</p>
                </div>
            </div>
        `;
    }
};

// Close modal function
window.closeBeritaModal = function() {
    const modal = document.getElementById('berita-modal');
    if (modal) {
        modal.classList.add('hidden');
    }
}; 