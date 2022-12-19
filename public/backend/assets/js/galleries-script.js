const imageList = document.querySelector(".image-grid-list");
const btnAdd = document.getElementById("btn-add-form");
const form = document.getElementById("form");

setInterval(displayImg, 1000);

if (
    window.location.href.split("/").splice(3, 4).join("/").split("?")[0] ==
    "admin/properties-gallery"
) {
    const btnEdit = document.querySelectorAll(".btn-edit");

    btnEdit.forEach((btn) => {
        btn.onclick = async (event) => {
            event.preventDefault();
            const form = document.getElementById("form");

            form.style.display = "none";

            const dataId = btn.getAttribute("data-id");

            const httpsSending = `properties-gallery/${dataId}/edit`;

            // TODO get data for edit data table
            const getResponse = await getEditData(httpsSending);

            // todo use destructing array to access inside data array
            const [data] = getResponse;

            form.style.display = "block";

            const formImage = form.querySelector("#images");

            console.log(formImage);

            const selectForm = form.querySelector("#properties-villa");
            const imageThumb = form.querySelector(".image_gallery");

            const dataSlug = data[2][0];
            const imageTemp = data[3];

            // TODO get data villa name
            data[0].forEach((data_villa) => {
                const option = document.createElement("option");
                option.value = data_villa.slug;

                if (option.value == dataSlug.slug) {
                    option.selected = true;
                }

                option.innerHTML = data_villa.property_villa_name;

                selectForm.appendChild(option);
            });

            imageThumb.setAttribute("src", imageTemp);

            formImage.onchange = (event) => {
                event.stopPropagation();

                let reader = new FileReader();

                reader.onload = (event) => {
                    imageThumb.setAttribute("src", event.target.result);
                };

                reader.readAsDataURL(formImage.files[0]);
            };

            form.setAttribute("action", `properties-gallery/${data[1].id}`);
        };
    });
}

function displayImg() {
    const images = document.querySelectorAll("input[name='images[]']");

    images.forEach((image) => {
        image.onchange = (event) => {
            const files = event.target.files;

            for (let i = 0; i < files.length; i++) {
                const Reader = new FileReader();

                Reader.onload = (event) => {
                    const imgFile = event.target;
                    const img = document.createElement("img");
                    img.classList.add("img-fluid", "d-block");
                    img.style.width = "24%";
                    img.src = imgFile.result;
                    imageList.appendChild(img);
                };

                Reader.readAsDataURL(files[i]);
            }
        };
    });
}

const getEditData = async (url) => {
    const dataResponse = [];

    const response = await fetch(url, {
        method: "GET",
        "Content-type": "application/json",
    });

    const { villa, galleries, galleries_category, imageTemp } =
        await response.json();

    dataResponse.push([villa, galleries, galleries_category, imageTemp]);

    return dataResponse;
};

if (
    window.location.href.split("/").splice(4, 5).join("/") ==
    "properties-gallery/create"
) {
    btnSubmit = document.getElementById("btn-create-galleries");

    btnAdd.onclick = (event) => {
        event.preventDefault();

        const firstDiv = document.createElement("div");
        const input = document.createElement("input");
        const formText = document.createElement("div");

        firstDiv.classList.add("mb-3");
        form.appendChild(firstDiv);

        form.insertBefore(firstDiv, btnSubmit);

        input.type = "file";
        input.name = "images[]";
        input.id = "images";
        input.classList.add("form-control");

        firstDiv.appendChild(input);
    };
}
