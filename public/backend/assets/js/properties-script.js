const csrfToken = document
    .querySelector("meta[name='csrf-token']")
    .getAttribute("content");

const btnEdit = document.querySelectorAll(".btn-edit");

btnEdit.forEach((btn) => {
    btn.onclick = async (event) => {
        const slug = btn.getAttribute("data-slug");
        const form = document.getElementById("form");

        form.style.display = "none";

        const httpSending = `properties-villa/${slug}/edit`;
        const getData = await getDataForm(httpSending);

        form.style.display = "block";

        const [dataEdit] = getData;
        const dataForm = dataEdit[0];
        const tempDropbox = dataEdit[1];
        const category = dataEdit[2];

        form.setAttribute("method", "POST");
        form.setAttribute("action", `properties-villa/${slug}`);
        const getForm = form.querySelectorAll(".form-control");

        getForm[0].value = dataForm.property_villa_name;
        getForm[1].value = dataForm.location;

        for (let i = 0; i < getForm[2].options.length; i++) {
            if (category.category_name == getForm[2].options.item(i).text) {
                getForm[2].options.item(i).selected = true;
            }
        }

        getForm[3].value = dataForm.price;
        getForm[4].value = dataForm.description;

        const imgThumb = form.querySelector(".img_thumbnail");

        imgThumb.setAttribute("src", tempDropbox);

        getForm[5].onchange = (event) => {
            event.stopPropagation();

            let reader = new FileReader();

            reader.onload = (event) => {
                imgThumb.setAttribute("src", event.target.result);
            };

            reader.readAsDataURL(getForm[getForm.length - 1].files[0]);
        };
    };
});

const getDataForm = async (url) => {
    const dataResponse = [];

    const response = await fetch(url, {
        method: "GET",
        header: {
            "Content-type": "application/json",
            accept: "application/json",
            "X-CSRF-Token": csrfToken,
        },
    });

    const { dataEdit, tempThumbnail, dataCategory } = await response.json();

    dataResponse.push([dataEdit, tempThumbnail, dataCategory]);

    return dataResponse;
};
