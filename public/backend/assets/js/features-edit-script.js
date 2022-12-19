const btnEdit = document.querySelectorAll(".btn-edit");

btnEdit.forEach((btn) => {
    btn.onclick = async (event) => {
        const form = document.getElementById("form");

        form.style.display = "none";

        const dataId = btn.getAttribute("data-id");

        const httpsSending = `properties-feature/${dataId}/edit`;

        const getResponse = await getEditData(httpsSending);
        const [data] = getResponse;

        form.style.display = "block";

        const dataVilla = data[0];
        const dataName = data[2][0];

        const selectForm = form.querySelector("#properties-villa");
        const formFeatures = form.querySelector("input[name='name_feature']");

        dataVilla.forEach((data_villa) => {
            const option = document.createElement("option");
            option.value = data_villa.slug;

            if (option.value == dataName.slug) {
                option.selected = true;
            }

            option.innerHTML = data_villa.property_villa_name;

            selectForm.appendChild(option);
        });

        formFeatures.value = data[1].name_feature;
        form.setAttribute("action", `properties-feature/${data[1].id}`);
    };
});

const getEditData = async (url) => {
    const dataResponse = [];

    const response = await fetch(url, {
        method: "GET",
        "Content-type": "application/json",
    });

    const { villa, features, propertySlug } = await response.json();

    dataResponse.push([villa, features, propertySlug]);

    return dataResponse;
};
