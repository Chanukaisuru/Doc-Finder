const btns = [
    { id: 1, distric: 'Matar' },
    { id: 2, distric: 'Galle' },
    { id: 3, distric: 'colombo' },
    { id: 4, distric: 'Gampaha' },
    { id: 5, distric: 'Kandy' },
    { id: 6, distric: 'Hambantota' },
    { id: 7, distric: 'Kalutara' }
];

document.getElementById('btns').innerHTML = btns.map(btn => {
    const { distric, id } = btn;
    return `<button class='fil-p' onclick='filterItems(${id})'>${distric}</button>`;
}).join('');

const card = [
    { id: 1, image: 'resources/img/selectDoctor_image.jpg', Name: 'Sampath', distric: 'Matar', Specile: 'genaral', hospital: 'Distric Genaral Hospital', rating: 4 },
    { id: 3, image: 'resources/img/selectDoctor_image.jpg', Name: 'Isuru', distric: 'colombo', Specile: 'genaral', hospital: 'Distric Genaral Hospital', rating: 5 },
    { id: 1, image: 'resources/img/selectDoctor_image.jpg', Name: 'Kamal', distric: 'Matar', Specile: 'genaral', hospital: 'Distric Genaral Hospital', rating: 3 },
    { id: 2, image: 'resources/img/selectDoctor_image.jpg', Name: 'Surith', distric: 'Galle', Specile: 'genaral', hospital: 'Distric Genaral Hospital', rating: 4 },
    { id: 1, image: 'resources/img/selectDoctor_image.jpg', Name: 'Sarith', distric: 'Matar', Specile: 'genaral', hospital: 'Distric Genaral Hospital', rating: 2 },
    { id: 3, image: 'resources/img/selectDoctor_image.jpg', Name: 'Sampath', distric: 'colombo', Specile: 'genaral', hospital: 'Distric Genaral Hospital', rating: 5 },
];

const categories = [...new Set(card.map(item => { return item }))];

const filterItems = (a) => {
    const filterCategories = categories.filter(item => item.id == a);
    displayItem(filterCategories);
}

const displayItem = (items) => {
    document.getElementById('root').innerHTML = items.map((item) => {
        var { image, Name, distric, Specile, hospital, rating } = item;
        return (
            `<div class="card">
                <div class="card-content">
                    <div class="image">
                        <img src=${image} alt="doc image">
                    </div>
                </div>
                <div class="name-profession">
                    <span class="name">${Name}</span>
                    <span class="specialty">${Specile}</span>
                    <span class="hospital">${hospital}</span>
                    <span class="distric">${distric}</span>
                </div>
                <div class="star">
                    ${generateStars(rating)}
                </div>
            </div>`
        )
    }).join('');
}

const generateStars = (rating) => {
    let stars = '';
    for (let i = 0; i < 5; i++) {
        if (i < rating) {
            stars += '<i class="fa-solid fa-star"></i>';
        } else {
            stars += '<i class="fa-regular fa-star"></i>';
        }
    }
    return stars;
}

displayItem(categories);
