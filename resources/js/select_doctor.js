const btns = [
    { id: 1, district: 'Matara' },
    { id: 2, district: 'Galle' },
    { id: 3, district: 'Colombo' },
    { id: 4, district: 'Gampaha' },
    { id: 5, district: 'Kandy' },
    { id: 6, district: 'Hambantota' },
    { id: 7, district: 'Kalutara' }
];

document.getElementById('btns').innerHTML = btns.map(btn => {
    const { district } = btn;
    return `<button class='fil-p' onclick='filterItems("${district}")'>${district}</button>`;
}).join('');

let doctors = [];

const fetchDoctors = () => {
    fetch('get_doctors.php')
        .then(response => response.json())
        .then(data => {
            doctors = data;
            displayDoctors(doctors);
        });
};

const filterItems = (district) => {
    const filteredDoctors = doctors.filter(doctor => doctor.district.toLowerCase() === district.toLowerCase());
    displayDoctors(filteredDoctors);
};

const displayDoctors = (doctors) => {
    document.getElementById('root').innerHTML = doctors.map(doctor => {
        const { reg_no, profile_photo, name, district, specialty, hospital } = doctor;
        return (
            `<div class="card" id="doctor-${reg_no}">
                <div class="card-content">
                    <div class="image">
                        <img src="${profile_photo}" alt="Doctor Image">
                    </div>
                </div>
                <div class="name-profession">
                    <span class="name">${name}</span>
                    <span class="specialty">${specialty}</span>
                    <span class="hospital">${hospital}</span>
                    <span class="district">${district}</span>
                </div>
            </div>`
        );
    }).join('');
};

fetchDoctors();
