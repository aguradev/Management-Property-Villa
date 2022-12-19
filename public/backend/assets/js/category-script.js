window.onload = () => {
    const csrfToken = document
        .querySelector("meta[name='csrf-token']")
        .getAttribute("content");

    const btnEdit = document.querySelectorAll(".btn-edit");

    const form = document.getElementById("form");

    // form.onsubmit = async (event) => {
    //     event.preventDefault();

    //     let category_name = formInput[0].value;
    //     let description = formInput[1].value;

    //     let data = {
    //         category_name: category_name,
    //         description: description,
    //     };

    //     submitData(
    //         `${window.location.protocol}//${window.location.host}/admin/categories-property`,
    //         "POST",
    //         data
    //     );
    // };

    btnEdit.forEach((btn) => {
        btn.onclick = async (event) => {
            event.preventDefault();

            const slug = btn.getAttribute("data-slug");
            const formEdit = Array.from(form.querySelectorAll(".form-control"));
            const sendingUrl = `categories-property/${slug}/edit`;

            const getDataEdit = await getData(sendingUrl);

            form.setAttribute("method", "POST");
            form.setAttribute("action", `categories-property/${slug}`);

            formEdit[0].value = getDataEdit.category_name;
            formEdit[1].value = getDataEdit.description;
        };
    });

    const getData = async (url) => {
        const response = await fetch(url, {
            method: "GET",
            "X-CSRF-TOKEN": csrfToken,
        });

        const { data } = await response.json();

        return data;
    };

    const submitData = async (url, mth, dataInput) => {
        try {
            const response = await fetch(url, {
                headers: {
                    "Content-type": "application/json",
                    Accept: "application/json, text-plain, */*",
                    "X-CSRF-TOKEN": csrfToken,
                    "X-Requested-With": "XMLHttpRequest",
                },
                method: mth,
                body: JSON.stringify(dataInput),
                credentials: "same-origin",
            });

            const { data } = await response.json();

            if (data.errors) {
                throw new ReferenceError("Data required");
            }

            console.log(data);
        } catch (error) {
            if (error instanceof ReferenceError) {
                console.log(error.message);
                return 0;
            }

            console.log(error.message);
        }
    };
};
