<template>
    <div class="downloadContainer">
        <div class="downloadContainer__content">
            <div class="downloadContainer__download" v-for="(download, index) in downloads" :key="index">
                <a class="download-btn" :href="download.file"><img width="25px" src="/download.svg" alt="download"> {{ download.caption }}</a>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    props: ['downloads'],
}
</script>

<style>
.download-btn {
    background-color: #000;
    color: #fff;
    padding: 10px 20px 10px 15px;
    text-transform: uppercase;
    letter-spacing: 2px;
    text-decoration: none;
    font-size: 1.2rem;
    font-weight: 700;
    transition: all 0.3s ease-in-out;
    display: inline-flex;
    align-items: center;
    margin-right: 20px;
    margin-bottom: 20px;
}

.downloadContainer__content {
    display: flex;
    flex-wrap: wrap;
    align-items: center;
}

.download-btn img {
    margin-right: 10px;
    transition: all .5s;
}

.download-btn:hover img{
    transform: translateY(3px);
}
</style>