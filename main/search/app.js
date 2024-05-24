function RedirectPageSoiree(element) {
    const idSoiree = element.getAttribute('data-id');
    const url = `../soiree/index.php?id_soiree=${idSoiree}`;
    window.location.href = url;
}