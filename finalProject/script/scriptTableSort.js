/**
 * Sorts a HTML table.
 * 
 * @param {HTMLTableElement} table The table to sort
 * @param {number} column The index of the column to sort
 * @param {boolean} asc Determines if the sorting will be in ascending
 */
function sortTableByColumn(table, column, asc = true) {
    const dirModifer = asc ? 1 : -1; 
    // Only works with ONE tBody tag
    const tBody = table.tBodies[0];
    const rows = Array.from(tBody.querySelectorAll("tr"));

    // Sort each row
    const sortedRows = rows.sort((a, b) => {
        const aColText = a.querySelector(`td:nth-child(${ column + 1})`).textContent.trim();
        const bColText = b.querySelector(`td:nth-child(${ column + 1})`).textContent.trim();

        return aColText > bColText ? (1 *  dirModifer) : (-1 * dirModifer);
    });

    // Remove all exisitng TRs from the table
    while (tBody.firstChild) {
        tBody.removeChild(tBody.firstChild);
    }
    // Readd newly sorted rows
    tBody.append(...sortedRows);
}

sortTableByColumn(document.querySelector("table"), 1, true);