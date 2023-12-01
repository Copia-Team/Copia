document.getElementById("calculateButton").addEventListener("click", function() {
    const dosis = parseFloat(document.getElementById("dosis").value);
    const jarakn = parseFloat(document.getElementById("jarakn").value);
    const jarakm = parseFloat(document.getElementById("jarakm").value);
    const ukurann = parseFloat(document.getElementById("ukurann").value);
    const ukuranm = parseFloat(document.getElementById("ukuranm").value);

    const nt = (ukurann*ukuranm) / (jarakn*jarakm);
    const luas_lahan = (ukurann*ukuranm) / 10000;
    const kebutuhan_perpetak = luas_lahan / 10000*dosis * 1000;
    const kebutuhan_pertanaman = kebutuhan_perpetak / nt; 
    const result = "Jumlah Tanaman Perpetak = "+ nt 
    +" tanaman/petak \nLuas Lahan = "+ luas_lahan 
    +" m² \nKebutuhan Pupuk Perpetak = "+ kebutuhan_perpetak 
    +" gram \nKebutuhan Pupuk Pertanaman = "+ kebutuhan_pertanaman + " gram/pertanaman";

    document.getElementById("result").value = result;
});