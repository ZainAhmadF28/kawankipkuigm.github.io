
document.addEventListener("DOMContentLoaded", function() {
    // Handle click on image items to scroll to a section
    document.querySelectorAll(".scroll-content .item").forEach(item => {
        item.addEventListener("click", function() {
            // Get the target section ID from the data-target attribute
            let targetId = this.getAttribute("data-target");
            let targetElement = document.getElementById(targetId);
            
            if (targetElement) {
                // Define offsets for different sections if needed
                let offset = 0;
                if (targetId === "acara1") {
                    offset = 80; // Adjust offset as needed
                }
                
                let elementPosition = targetElement.getBoundingClientRect().top + window.scrollY;
                window.scrollTo({
                    top: elementPosition - offset,
                    behavior: 'smooth'
                });
            }
        });
    });
});

document.getElementById('view-docs-btn').addEventListener('click', function() {
    var docsContainer = document.getElementById('docs-container');
    if (docsContainer.style.display === "none" || docsContainer.style.display === "") {
        docsContainer.style.display = "block";
    } else {
        docsContainer.style.display = "none";
    }
});

document.getElementById('ask-me-btn').addEventListener('click', function() {
    let data = {
        question: prompt("What would you like to ask?"),
        timestamp: new Date().toISOString()
    };

    fetch('saveAskMe.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify(data)
    })
    .then(response => response.json())
    .then(result => {
        alert('Your question has been saved!');
    })
    .catch(error => {
        console.error('Error:', error);
    });
});
