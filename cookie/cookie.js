//// cookie.js
        document.addEventListener('DOMContentLoaded', function () {
        const setCookieBtn = document.getElementById('setCookieBtn');
        const getCookieBtn = document.getElementById('getCookieBtn');
        const cookieDisplay = document.getElementById('cookieDisplay');
        const cookieResult = document.getElementById('cookieResult');
        const getCookieInput = document.getElementById('getCookieInput');
        const cookieNameInput = document.getElementById('cookieNameInput');
        const stateInput = document.getElementById('stateInput');

        // Fungsi untuk menyetel cookie
        function setCookie(name, value, days) {
            const date = new Date();
            date.setTime(date.getTime() + days * 24 * 60 * 60 * 1000);
            document.cookie = `${name}=${encodeURIComponent(value)};expires=${date.toUTCString()};path=/`;
            alert(`Cookie "${name}" berhasil disimpan!`);
            updateDisplayedCookie(name);
        }

        // Fungsi untuk mendapatkan cookie tertentu
        function getCookie(name) {
            const cookies = document.cookie.split('; ').reduce((acc, cookie) => {
                const [key, val] = cookie.split('=');
                acc[key] = decodeURIComponent(val);
                return acc;
            }, {});
            return cookies[name] || null;
        }

        // Fungsi untuk memperbarui tampilan nilai cookie
        function updateDisplayedCookie(name) {
            const value = getCookie(name);
            cookieDisplay.textContent = value ? `${value}` : 'Belum ada nilai';
        }

        // Event listener untuk Set Cookie
        setCookieBtn.addEventListener('click', function () {
            const cookieName = cookieNameInput.value.trim();
            const value = stateInput.value.trim();

            if (!cookieName || !value) {
                alert('Masukkan nama cookie dan nilainya terlebih dahulu!');
                return;
            }
            setCookie(cookieName, value, 7);
        });

        // Event listener untuk Get Cookie
        getCookieBtn.addEventListener('click', function () {
            const cookieName = getCookieInput.value.trim();
            if (!cookieName) {
                alert('Masukkan nama cookie untuk dicari!');
                return;
            }
            const result = getCookie(cookieName);
            if (result) {
                cookieResult.textContent = `Nilai Cookie: ${result}`;
                cookieResult.classList.remove('text-danger');
                cookieResult.classList.add('text-success');
            } else {
                cookieResult.textContent = 'Cookie tidak ditemukan.';
                cookieResult.classList.remove('text-success');
                cookieResult.classList.add('text-danger');
                alert('Cookie tidak ditemukan. Pastikan nama cookie benar!');
            }
        });
      });

      // Set LocalStorage
      document.getElementById("setLocalStorageBtn").addEventListener("click", function () {
        const value = stateInput.value;
        if (value.trim() === "") {
          alert("Masukkan nilai terlebih dahulu!");
          return;
        }
        localStorage.setItem("userLocalStorage", value);
        perbaruiTampilan();
      });

      // Set SessionStorage
      document.getElementById("setSessionStorageBtn").addEventListener("click", function () {
        const value = stateInput.value;
        if (value.trim() === "") {
          alert("Masukkan nilai terlebih dahulu!");
          return;
        }
        sessionStorage.setItem("userSessionStorage", value);
        perbaruiTampilan();
      });

      // Fungsi untuk memperbarui tampilan nilai
      function perbaruiTampilan() {


          // Tampilkan LocalStorage
          const localStorageValue = localStorage.getItem("userLocalStorage");
          localStorageDisplay.textContent = localStorageValue || "Belum ada nilai";
        
          // Tampilkan SessionStorage
          const sessionStorageValue = sessionStorage.getItem("userSessionStorage");
          sessionStorageDisplay.textContent = sessionStorageValue || "Belum ada nilai";
        }
        
        // Inisialisasi tampilan
        perbaruiTampilan();
        // Perbarui tampilan saat halaman dimuat
        updateDisplayedCookie('exampleCookie');
      ;
