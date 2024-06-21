document.addEventListener('DOMContentLoaded', function () {
    const metaCacheControl = document.createElement('meta');
    metaCacheControl.httpEquiv = "Cache-Control";
    metaCacheControl.content = "no-store";
    document.head.appendChild(metaCacheControl);

    const metaPragma = document.createElement('meta');
    metaPragma.httpEquiv = "Pragma";
    metaPragma.content = "no-cache";
    document.head.appendChild(metaPragma);

    const metaExpires = document.createElement('meta');
    metaExpires.httpEquiv = "Expires";
    metaExpires.content = "0";
    document.head.appendChild(metaExpires);

    console.log("Cache-control meta tags added.");
});
