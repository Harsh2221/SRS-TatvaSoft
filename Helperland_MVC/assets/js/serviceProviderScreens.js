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

        window.addEventListener('DOMContentLoaded', event => {

            // Toggle the side navigation
            const sidebarToggle = document.body.querySelector('#sidebarToggle');
            if (sidebarToggle) {
                // Uncomment Below to persist sidebar toggle between refreshes
                // if (localStorage.getItem('sb|sidebar-toggle') === 'true') {
                //     document.body.classList.toggle('sb-sidenav-toggled');
                // }
                sidebarToggle.addEventListener('click', event => {
                    event.preventDefault();
                    document.body.classList.toggle('sb-sidenav-toggled');
                    localStorage.setItem('sb|sidebar-toggle', document.body.classList.contains('sb-sidenav-toggled'));
                });
            }
        
        });