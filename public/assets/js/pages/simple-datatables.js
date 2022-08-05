let dataTable = new simpleDatatables.DataTable(document.getElementById("table1"));
function adaptPageDropdown() {
    const a = dataTable
        .wrapper
        .querySelector(".dataTable-selector");
    a
        .parentNode
        .parentNode
        .insertBefore(a, a.parentNode),
    a
        .classList
        .add("form-select")
}
function adaptPagination() {
    const a = dataTable
        .wrapper
        .querySelectorAll("ul.dataTable-pagination-list");
    for (const t of a) 
        t
            .classList
            .add("pagination", "pagination-primary");
    const t = dataTable
        .wrapper
        .querySelectorAll("ul.dataTable-pagination-list li");
    for (const a of t) 
        a
            .classList
            .add("page-item");
    const e = dataTable
        .wrapper
        .querySelectorAll("ul.dataTable-pagination-list li a");
    for (const a of e) 
        a
            .classList
            .add("page-link")
    }
dataTable.on("datatable.init", (function () {
    adaptPageDropdown(),
    adaptPagination()
})),
dataTable.on("datatable.page", adaptPagination);
