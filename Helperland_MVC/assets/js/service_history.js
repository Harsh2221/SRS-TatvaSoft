const listItems = document.querySelectorAll('.list-group-item');
const unClickAll = function() {
            listItems.forEach((item)=> item.classList.remove('active'));
        }
        const activateClicked = (e) =>{
            unClickAll();
            e.target.classList.add('active');
        }
        listItems.forEach(item =>{
            item.addEventListener('click', activateClicked);
})


