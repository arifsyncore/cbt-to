<script>
    const btnDetailTo = document.querySelectorAll('.selengkapnya-to')
    btnDetailTo.forEach(function(btn) {
        btn.addEventListener('click', function() {
            let id = this.dataset.id
            window.location.href = `/soal-to?id=${id}`
        })
    })

    const btnDetailKat = document.querySelectorAll('.selengkapnya-kat')
    btnDetailKat.forEach(function(btn) {
        btn.addEventListener('click', function() {
            let id = this.dataset.id
            window.location.href = `/kategori/detail?id=${id}`
        })
    })
</script>
