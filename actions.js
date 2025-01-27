document.addEventListener('DOMContentLoaded', function() {
    // Menangani klik pada ikon suka dan bookmark
    const buttons = document.querySelectorAll('.like-button, .bookmark-button');
    buttons.forEach(button => {
        button.addEventListener('click', function() {
            const idResep = this.getAttribute('data-id_resep');
            const idPengguna = this.getAttribute('data-id_pengguna');
            const action = this.classList.contains('like-button') ? 'like' : 'bookmark';

            if (!idPengguna) {
                alert('Anda harus login untuk melakukan aksi ini');
                return;
            }

            const xhr = new XMLHttpRequest();
            xhr.open('POST', action === 'like' ? 'suka.php' : 'bookmark.php', true);
            xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
            xhr.onload = function() {
                if (this.status == 200) {
                    if (action === 'like') {
                        if (this.responseText == 'liked') {
                            button.classList.add('liked');
                        } else if (this.responseText == 'unliked') {
                            button.classList.remove('liked');
                        }
                    } else if (action === 'bookmark') {
                        if (this.responseText == 'bookmarked') {
                            button.classList.add('bookmarked');
                        } else if (this.responseText == 'unbookmarked') {
                            button.classList.remove('bookmarked');
                        }
                    }
                }
            };
            xhr.send(`id_resep=${idResep}&id_pengguna=${idPengguna}`);
        });
    });
});
