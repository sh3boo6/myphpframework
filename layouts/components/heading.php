<script>
    const Heading = {
        props: ['title'],
        template: `
            <header class="bg-light p-3 rounded-3 border px-4">
                <div class="fs-4">{{ title }}</div>
            </header>
        `
    }
</script>