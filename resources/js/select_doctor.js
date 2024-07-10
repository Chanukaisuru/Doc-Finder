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

const card=[
    {id:1, image:'resources/img/selectDoctor_image.jpg', Name:'Sampath', distric:'Matar', Specile:'genaral'},
    {id:3, image:'resources/img/selectDoctor_image.jpg', Name:'Isuru', distric:'colombo', Specile:'genaral'},
    {id:1, image:'resources/img/selectDoctor_image.jpg', Name:'Kamal', distric:'Matar', Specile:'genaral'},
    {id:2, image:'resources/img/selectDoctor_image.jpg', Name:'Surith', distric:'Galle', Specile:'genaral'},
    {id:1, image:'resources/img/selectDoctor_image.jpg', Name:'Sarith', distric:'Matar', Specile:'genaral'},
    {id:3, image:'resources/img/selectDoctor_image.jpg', Name:'Sampath', distric:'colombo', Specile:'genaral'},
]

const categories= [...new Set(card.map((item)=>
    {return item}))]

const filterItems=(a)=>{
    const filterCategories=categories.filter(item);
    function item(value){
        if(value.id==a){
            return(
                value.id
            )
        }
    }
    displayItem(filterCategories)
}    

const displayItem =(items) =>{
    document.getElementById('root') .innerHTML =items.map((item)=>
    {
        var {image,Name,distric,Specile}=item;
        return(
            `<div class='box'>
                <h3>${Name}</h3>
                <div class='img-box'>
                    <img class='selectDoctor_image' src=${image}></img>
                </div>
                <h2>${distric}</h2>
                <h2>${Specile}</h2>
            </div>`)
    } ).join('');
}
displayItem(categories);      