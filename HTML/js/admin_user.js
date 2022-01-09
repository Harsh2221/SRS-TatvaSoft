const listItems = document.querySelectorAll('#sidebar ul li a');
        const unClickAll = function() {
            listItems.forEach((item)=> item.classList.remove('link-active'));
        }
        const activateClicked = (e) =>{
            unClickAll();
            e.target.classList.add('link-active');
        }
        listItems.forEach(item =>{
            item.addEventListener('click', activateClicked);
        })

       