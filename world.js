window.onload = function () {
    const lookupBtn = document.getElementById("lookup");
    const lookupCitiesBtn = document.getElementById("lookup-cities");
    const result = document.getElementById("result");

    lookupBtn.addEventListener("click", function () {
        const country = document.getElementById("country").value;
        fetch(`world.php?country=${country}`)
            .then(response => response.text())
            .then(data => {
                result.innerHTML = data;
            })
            .catch(err => console.error(err));
    });

    lookupCitiesBtn.addEventListener("click", function () {
        const country = document.getElementById("country").value;
        fetch(`world.php?country=${country}&lookup=cities`)
            .then(response => response.text())
            .then(data => {
                result.innerHTML = data;
            })
            .catch(err => console.error(err));
    });
};
