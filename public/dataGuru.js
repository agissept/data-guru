$.fn.select2.defaults.set("theme", "bootstrap4")

async function initView(page, randomData, time) {

    if (page === 'tambah_guru') {
        if (randomData === false) {
            $('#namaSekolah').select2({
                placeholder: 'Pilih Sekolah'
            });
            $('#tanggalLahir').datetimepicker({
                format: 'L',
                format: 'YYYY-MM-DD'
            })
            $('#tmtPangkatTerakhir').datetimepicker({
                format: 'L',
                format: 'YYYY-MM-DD'
            })
            $('#kgb').datetimepicker({
                format: 'L',
                format: 'YYYY-MM-DD'
            })
        } else {
            await pause(time);
            randomGuru()
        }
    } else if (page === 'tambah_sekolah') {
        if (randomData === false) {
            initSelectKota(null, null, null);
        } else {
            await pause(time);
            randomSekolah()
        }
    }
}

function randomGuru() {
    randomSelect('namaSekolah')
    randomSelect('pangkat')
    $('#nama').val(randomName())
    $('#nip').val(randomId())
    $('#nuptk').val(randomId())
    $('#tanggalLahir').val(randomDateOfBirth())
    $('#tmtPangkatTerakhir').val(randomDateNow())
    $('#kgb').val(randomDateNow())
    randomSelect('jabatan')
    $('#formTambahGuru').submit();
}

var kota
var kecamatan
var kelurahan
var token

async function randomSekolah() {
    randomSelect('selectKota', true);
    var kota = randomSelect('selectKota', true);
    await getKecamatan(kota);
    var kecamatan = randomSelect('selectKecamatan', true);
    await getKelurahan(kecamatan);
    var kelurahan = randomSelect('selectKelurahan', true);
    $('#alamat').val(randomAdress());
    $('#sekolah').val($('#jenjang').val() + ' ' + $('#selectKecamatan :selected').text() + ' ' + randomNumber(1, 20))
    $('#koordinat').val(Math.random());
    $('#formTambahGuru').submit();
}

function getToken() {
    var url = "https://x.rajaapi.com/poe"
    return $.get(url)
}

function getKota() {
    var idProvinsi = 32
    var url = "https://x.rajaapi.com/MeP7c5ne" + token + "/m/wilayah/kabupaten?idpropinsi=" + idProvinsi;
    return $.get(url);
}

function getKecamatan(namaKota) {
    var idKota = getId(namaKota, kota)
    var url = "https://x.rajaapi.com/MeP7c5ne" + token + "/m/wilayah/kecamatan?idkabupaten=" + idKota;
    return $.get(url);
}

function getKelurahan(namaKecamatan) {
    var idKecamatan = getId(namaKecamatan, kecamatan)
    var url = "https://x.rajaapi.com/MeP7c5ne" + token + "/m/wilayah/kelurahan?idkecamatan=" + idKecamatan;
    return $.get(url);
}

function getId(nameKey, myArray) {
    for (var i = 0; i < myArray.length; i++) {
        if (myArray[i].name === nameKey) {
            return myArray[i].id;
        }
    }
}

var selectKecamatan
var selectKota
var selectKelurahan

async function initSelectKota(selectedKota, selectedKecamatan, selectedKelurahan) {
    selectKecamatan = $("#selectKecamatan")
    selectKota = $("#selectKota")
    selectKelurahan = $("#selectKelurahan")

    await getToken().then((res) => {
        token = res.token
    })
    await getKota().then((res) => {
        kota = res.data
    })
    const data = [
        "KOTA BANDUNG",
        "KOTA CIMAHI"
    ]
    if (selectedKota === null) {
        data.pop("")
    }
    selectKota.select2({
        data: data,
        placeholder: 'Pilih Kota'
    }).on('change', function (e) {
        getKecamatan(e.target.value).then((res) => {
            selectKecamatan.empty();
            selectKelurahan.empty();

            initSelectKecamatan(null, null)
        })
    })
    if (selectedKota !== null) {
        selectKota.val(selectedKota).trigger("change")
        initSelectKecamatan(selectedKecamatan, selectedKelurahan)
    }
}

async function initSelectKecamatan(selectedKecamatan, selectedKelurahan) {
    await getKecamatan($("#selectKota").val()).then((res) => {
        kecamatan = res.data
    })
    if (selectedKecamatan === null) {
        kecamatan.unshift({
            id:'',
            name:''
        })
    }
    selectKecamatan.select2({
        data: $.map(kecamatan, (value) => {
            return value.name
        }),
        placeholder: 'Pilih Kecamatan'
        
    })

    if (selectedKecamatan !== null) {
        selectKecamatan.val(selectedKecamatan)
            .trigger("change")
        initSelectKelurahan(selectedKelurahan)
    }
    selectKecamatan.on('change', (e) => {
        getKelurahan(e.target.value).then((res) => {
            selectKelurahan.empty()
            initSelectKelurahan(null)
        })
    });
}

async function initSelectKelurahan(selectedKelurahan) {
    await getKelurahan($("#selectKecamatan").val()).then((res) => {
        kelurahan = res.data
    })
    if (selectedKelurahan === null) {
        kelurahan.unshift({
            id:'',
            name:''
        })
    }
    selectKelurahan.select2({
        data: $.map(kelurahan, (value) => {
            return value.name
        }),
        placeholder: 'Pilih Kelurahan'
    })
    if (selectedKelurahan !== null) {
        selectKelurahan.val(selectedKelurahan)
            .trigger("change");
    }
}

async function pause(time) {
    return wait(time);
}

function wait(time) {
    return new Promise(resolve => {
        setTimeout(() => {
            resolve();
        }, time);
    });
}

function randomId() {
    const min = 300000000000
    const max = 400000000000
    return randomNumber(min, max)
}

function randomDateOfBirth() {
    const startBirth = new Date(1950, 1, 1)
    const endBirth = new Date(1985, 12, 31)
    return randomDate(startBirth, endBirth)
}

function randomDateNow() {
    const start = new Date(2017, 1, 1)
    const end = new Date(2020, 2, 22)
    return randomDate(start, end);
}

function randomNumber(min, max) {
    return Math.floor(Math.random() * (max - min + 1) + min)
}

function randomDate(start, end) {
    var d = new Date(start.getTime() + Math.random() * (end.getTime() - start.getTime())),
        month = '' + (d.getMonth() + 1),
        day = '' + d.getDate(),
        year = d.getFullYear();

    if (month.length < 2) month = '0' + month;
    if (day.length < 2) day = '0' + day;
    return [year, month, day].join('-');
}

function randomSelect(id, zero = false) {
    var select = document.getElementById(id);
    var items = select.getElementsByTagName('option');
    var index = Math.floor(Math.random() * items.length);
    if (zero === true && index === 0) {
        index = 1;
    }
    select.selectedIndex = index
    return select.options[index].value
}

function randomName() {
    const arrayName = [
        "Mochammad Imania",
        "Agus Risyad",
        "Adam Sherina",
        "Fauzi Tiara",
        "Deka Bisri",
        "Dimas Aristy",
        "Dee Zakia",
        "Aulia Noor",
        "Finaldi Pambudi",
        "Chaerul Adam Dinantika",
        "Ari Izhar",
        "Rezky Daniel Bertauli",
        "Andhicha Rosmalia",
        "Bob Mawarni",
        "Irsan Michael Suheryanto",
        "Ficky Bryan Yuliasti",
        "Yosafat Novitasari",
        "Andrie S",
        "Anas Haq",
        "Bintang Ardina",
        "Ferdiansyah Cahyani",
        "Sebastian Sigit Ulfania",
        "Satrya Maulidah",
        "Rian Ari Maulinda",
        "Fahlian Izhar Prayogi",
        "Mark Zahra",
        "Devito Fatimah",
        "Alditio Dewi",
        "Abdullah Sinuka",
        "Mirza Falah",
        "Hizkia Julianto",
        "Naufal Mario Puspa",
        "Edy Astuti",
        "Ryan Anisa",
        "Aprian Naenggolan",
        "Nauval Rizkia",
        "Haikal Rompas",
        "Romario Ryan Usra",
        "Revi Tursia",
        "Arthur Chandra",
        "Ramanta Larashaty",
        "Azrul Ramanta Indriani",
        "Hudzaifah Rafles",
        "Ekka Varensia",
        "Surya Agustina",
        "Firdaus Lukman Lestari",
        "Pandu Amelia",
        "Fariz Sulistyaningra",
        "Syahid Rahman",
        "Aristyo Defri"
    ]

    return arrayName[Math.floor(Math.random() * arrayName.length)]
}

function randomAdress() {
    const arrayStreet = [
        "Dk. Sutami No. 850",
        "Ds. Honggowongso No. 234",
        "Gg. Bakin No. 797",
        "Ki. Badak No. 198",
        "Psr. Sunaryo No. 429",
        "Ds. Gedebage Selatan No. 569",
        "Gg. Flores No. 790",
        "Kpg. K.H. Maskur No. 929",
        "Gg. Bappenas No. 31",
        "Gg. Pasir Koja No. 24",
        "Kpg. Kalimantan No. 210",
        "Ki. Sutan Syahrir No. 998",
        "Gg. Asia Afrika No. 781",
        "Kpg. K.H. Maskur No. 299",
        "Ds. Basuki Rahmat  No. 43",
        "Jr. Ters. Buah Batu No. 61",
        "Dk. Otista No. 801",
        "Jln. Bakti No. 999",
        "Gg. Ekonomi No. 1",
        "Ki. Baik No. 853",
        "Jln. Pacuan Kuda No. 972",
        "Gg. Cemara No. 889",
        "Jln. Thamrin No. 122",
        "Ki. Lumban Tobing No. 29",
        "Jln. Fajar No. 60"
    ]
    return arrayStreet[Math.floor(Math.random() * arrayStreet.length)]
}
