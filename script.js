// Data event (contoh)
const events = [
    {
        id: 1,
        title: "Seminar Teknologi",
        date: "2023-10-15",
        description: "Seminar tentang perkembangan teknologi terbaru.",
        image: "https://via.placeholder.com/400x200?text=Seminar+Teknologi"
    },
    {
        id: 2,
        title: "Lomba Coding",
        date: "2023-11-01",
        description: "Lomba coding untuk mahasiswa.",
        image: "https://via.placeholder.com/400x200?text=Lomba+Coding"
    },
    {
        id: 3,
        title: "Pelatihan Soft Skills",
        date: "2023-11-15",
        description: "Pelatihan untuk meningkatkan soft skills.",
        image: "https://via.placeholder.com/400x200?text=Soft+Skills"
    }
];

// Daftar pendaftaran (contoh)
let registrations = [];

// Tampilkan daftar event
const eventList = document.getElementById('events');
events.forEach(event => {
    const eventCard = document.createElement('div');
    eventCard.classList.add('bg-white', 'p-6', 'rounded-2xl', 'shadow-lg', 'hover:shadow-xl', 'transition', 'duration-300');
    eventCard.innerHTML = `
        <img src="${event.image}" alt="${event.title}" class="w-full h-48 object-cover rounded-lg mb-4">
        <h3 class="text-xl font-bold text-slate-900">${event.title}</h3>
        <p class="text-gray-600 mb-2">Tanggal: ${event.date}</p>
        <p class="text-gray-800 mb-4">${event.description}</p>
        <button class="bg-sky-900 text-white px-4 py-2 rounded-lg w-full hover:bg-sky-800 transition" onclick="showRegisterForm(${event.id})">Daftar</button>
    `;
    eventList.appendChild(eventCard);
});

// Fungsi untuk menampilkan form pendaftaran
const registerFormSection = document.getElementById('register-form');
const eventSelect = document.getElementById('event-select');

function showRegisterForm(eventId) {
    registerFormSection.classList.remove('hidden');
    registerFormSection.scrollIntoView({ behavior: 'smooth' });
    eventSelect.innerHTML = '';
    events.forEach(event => {
        const option = document.createElement('option');
        option.value = event.id;
        option.textContent = event.title;
        if (event.id === eventId) {
            option.selected = true;
        }
        eventSelect.appendChild(option);
    });
}

// Handle submit form pendaftaran
const registrationForm = document.getElementById('registration-form');
registrationForm.addEventListener('submit', (e) => {
    e.preventDefault();
    const name = document.getElementById('name').value;
    const email = document.getElementById('email').value;
    const phone = document.getElementById('phone').value;
    const eventId = document.getElementById('event-select').value;

    const registration = {
        name,
        email,
        phone,
        eventId
    };

    registrations.push(registration);
    alert('Pendaftaran berhasil!');
    registrationForm.reset();
    registerFormSection.classList.add('hidden');
});

// Handle cek status pendaftaran
const statusForm = document.getElementById('status-form');
const statusResult = document.getElementById('status-result');

statusForm.addEventListener('submit', (e) => {
    e.preventDefault();
    const email = document.getElementById('status-email').value;
    const userRegistrations = registrations.filter(reg => reg.email === email);

    if (userRegistrations.length > 0) {
        let resultHtml = '<h3 class="text-lg font-bold text-slate-900">Status Pendaftaran:</h3><ul class="list-disc pl-5">';
        userRegistrations.forEach(reg => {
            const event = events.find(e => e.id == reg.eventId);
            resultHtml += `<li>${event.title} - Terdaftar</li>`;
        });
        resultHtml += '</ul>';
        statusResult.innerHTML = resultHtml;
    } else {
        statusResult.innerHTML = '<p class="text-red-600">Email tidak ditemukan atau belum mendaftar.</p>';
    }
});