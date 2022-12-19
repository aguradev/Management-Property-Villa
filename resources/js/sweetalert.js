import Swal from "sweetalert2";

const geUrl = window.location.href;
const urlSplit = geUrl.split("/");

const flashMessage = document.getElementById("flash-message");
const flashMessageData = flashMessage.getAttribute("data-message");
if (flashMessageData) {
    Swal.fire({
        title: "Success!",
        text: flashMessageData,
        icon: "success",
        confirmButtonText: "ok",
    });
}

const token = document
    .querySelector("meta[name='csrf-token']")
    .getAttribute("content");

const btnDelete = document.querySelectorAll(".btn-delete");
const btnUpdate = document.querySelectorAll(".btn-edit");

if (urlSplit[4].split("?")[0] == "properties-gallery") {
    btnDelete.forEach((btn) => {
        btn.onclick = async (event) => {
            event.preventDefault();

            const deleteId = btn.getAttribute("data-id");
            const selectedRow = document.querySelector("tr.data-table");

            Swal.fire({
                title: "Are you sure?",
                text: "Are you want to delete this data ? ",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Yes, delete it!",
            }).then(async (result) => {
                if (result.isConfirmed) {
                    const httpSending = `/admin/properties-gallery/${deleteId}`;
                    submitData(httpSending, "delete");

                    selectedRow.remove();

                    Swal.fire(
                        "Deleted!",
                        "Your data has been deleted.",
                        "success"
                    );
                }
            });
        };
    });
}

if (urlSplit[4].split("?")[0] == "properties-villa") {
    const btnDelete = document.querySelectorAll(".btn-delete");

    btnDelete.forEach((btn) => {
        btn.onclick = (event) => {
            event.preventDefault();

            const slug = btn.getAttribute("data-slug");
            const selectedRow = document.querySelector(`tr[data-slug=${slug}]`);

            Swal.fire({
                title: "Are you sure?",
                text: "Are you want to delete this data ? ",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Yes, delete it!",
            }).then((result) => {
                if (result.isConfirmed) {
                    const httpSending = `/admin/properties-villa/${slug}`;
                    submitData(httpSending, "delete");
                    Swal.fire(
                        "Deleted!",
                        "Your data has been deleted.",
                        "success"
                    );

                    selectedRow.remove();
                }
            });
        };
    });
}

if (urlSplit[4].split("?")[0] == "properties-feature") {
    const btnDelete = document.querySelectorAll(".btn-delete");

    btnDelete.forEach((btn) => {
        btn.onclick = (event) => {
            event.preventDefault();

            const id = btn.getAttribute("data-id");
            const selectedRow = document.querySelector("tr.data-table");

            Swal.fire({
                title: "Are you sure?",
                text: "Are you want to delete this data ? ",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Yes, delete it!",
            }).then((result) => {
                if (result.isConfirmed) {
                    const httpSending = `/admin/properties-feature/${id}`;
                    submitData(httpSending, "delete");
                    Swal.fire(
                        "Deleted!",
                        "Your data has been deleted.",
                        "success"
                    );

                    selectedRow.remove();
                }
            });
        };
    });
}

if (urlSplit[4] == "categories-property") {
    btnDelete.forEach((btn) => {
        btn.onclick = (event) => {
            event.preventDefault();

            const slug = btn.getAttribute("data-slug");
            const selectedRow = document.querySelector(`tr[data-slug=${slug}]`);

            Swal.fire({
                title: "Are you sure?",
                text: "Are you want to delete this data ? ",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Yes, delete it!",
            }).then((result) => {
                if (result.isConfirmed) {
                    const httpSending = `/admin/categories-property/${slug}`;
                    submitData(httpSending, "delete");
                    Swal.fire(
                        "Deleted!",
                        "Your data has been deleted.",
                        "success"
                    );

                    selectedRow.remove();
                }
            });
        };
    });
}

const submitData = async (url, method) => {
    try {
        const response = await fetch(url, {
            headers: {
                "Content-type": "application/json",
                Accept: "application/json, text-plain, */*",
                "X-Requested-With": "XMLHttpRequest",
                "X-CSRF-TOKEN": token,
            },
            method: method,
        });

        const { data } = await response.json();

        return data;
    } catch (error) {
        console.log(error.message);
    }
};
