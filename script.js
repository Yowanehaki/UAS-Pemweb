        // Validasi form untuk memastikan semua field diisi sebelum submit
        const form = document.getElementById('formEdit');
        form.addEventListener('submit', function (e) {
        const nim = document.getElementById('nim');
        const nama = document.getElementById('nama');
        const email = document.getElementById('email');
        const jenisKelamin = document.getElementById('jenis_kelamin');
        const asal = document.getElementById('asal');
        const confirmBox = document.getElementById('confirm');

        // Hapus pesan error sebelumnya
        document.querySelectorAll('.error-message').forEach(error => error.remove());

        let isValid = true;

        // Fungsi untuk menampilkan pesan error
        function showError(input, message) {
            const error = document.createElement('span');
            error.className = 'error-message';
            error.style.color = 'red';
            error.style.fontSize = '0.9rem';
            error.innerText = message;
            input.parentElement.appendChild(error);
        }

        // Validasi NIM
        if (nim.value.trim() === '') {
            isValid = false;
            showError(nim, 'NIM harus diisi.');
        }

        // Validasi Nama
        if (nama.value.trim() === '') {
            isValid = false;
            showError(nama, 'Nama harus diisi.');
        }

        // Validasi Email
        if (email.value.trim() === '') {
            isValid = false;
            showError(email, 'Email harus diisi.');
        } else if (!/^\S+@\S+\.\S+$/.test(email.value.trim())) {
            isValid = false;
            showError(email, 'Format email tidak valid.');
        }

        // Validasi Jenis Kelamin
        if (jenisKelamin.value.trim() === '') {
            isValid = false;
            showError(jenisKelamin, 'Jenis kelamin harus dipilih.');
        }

        // Validasi Asal
        if (asal.value.trim() === '') {
            isValid = false;
            showError(asal, 'Asal harus diisi.');
        }

        // Validasi Checkbox
        if (!confirmBox.checked) {
            isValid = false;
            const confirmError = document.createElement('span');
            confirmError.className = 'error-message';
            confirmError.style.color = 'red';
            confirmError.style.fontSize = '0.9rem';
            confirmError.innerText = 'Anda harus mencentang "Apakah data sudah benar?".';
            confirmBox.parentElement.appendChild(confirmError);
        }

        // Jika tidak valid, cegah pengiriman form
        if (!isValid) {
            e.preventDefault();
        }
    });

    // Validasi input saat halaman dimuat
        document.addEventListener('DOMContentLoaded', function () {
        const form = document.getElementById('formEdit');
        const nim = document.getElementById('nim');
        const nama = document.getElementById('nama');
        const email = document.getElementById('email');
        const jenisKelamin = document.getElementById('jenis_kelamin');
        const asal = document.getElementById('asal');
        const confirmBox = document.getElementById('confirm');

        // Fungsi untuk memvalidasi input
        function validateInputs() {
        const isNimValid = nim.value.trim() !== '';
        const isNamaValid = nama.value.trim() !== '';
        const isEmailValid = email.value.trim() !== '';
        const isJenisKelaminValid = jenisKelamin.value.trim() !== '';
        const isAsalValid = asal.value.trim() !== '';

        // Aktifkan checkbox jika semua input valid
        if (isNimValid && isNamaValid && isEmailValid && isJenisKelaminValid && isAsalValid) {
            confirmBox.disabled = false; // Aktifkan checkbox
        } else {
            confirmBox.disabled = true; // Tetap nonaktif jika ada input yang kosong
        }
        }

        // Tambahkan event listener untuk setiap input
        [nim, nama, email, jenisKelamin, asal].forEach(input => {
        input.addEventListener('input', validateInputs);
        input.addEventListener('change', validateInputs);
        });
        });

        // Tambahkan event listener ke tombol submit form
        document.addEventListener('DOMContentLoaded', function () {
            // Tambahkan event listener ke semua link dengan class 'delete'
            const deleteLinks = document.querySelectorAll('.delete');
            deleteLinks.forEach(link => {
                link.addEventListener('click', function (e) {
                    const confirmation = confirm('Apakah Anda yakin ingin menghapus data ini?');
                    if (!confirmation) {
                        e.preventDefault(); // Cegah tindakan default jika pengguna membatalkan
                    } 
                });
            });

        // Tambahkan event listener ke semua link dengan class 'edit'
        const editLinks = document.querySelectorAll('.edit');
        editLinks.forEach(link => {
            link.addEventListener('click', function (e) {
                const confirmation = confirm('Apakah Anda yakin ingin mengubah data ini?');
                if (!confirmation) {
                    e.preventDefault(); // Cegah tindakan default jika pengguna membatalkan
                }
            });
        });
    });

