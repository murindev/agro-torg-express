<template>
    <div class="adsSectionSlider">
        <carousel
                class="adsSectionSlider-items"
                :perPageCustom="[[2, 1],[768, 1], [1024, 2], [1200, 2]]"
                :navigationEnabled="true"
                navigationNextLabel="&rsaquo;"
                navigationPrevLabel="&lsaquo;"
        >
            <slide v-for="item in 8" :key="item">

                <div class="img" :style="'background: url('+image+') no-repeat; background-size: cover'">

                </div>
                <div class="txt">
                    <p>Как стать фермером</p>
                    <a href="javascript:">Все секреты</a>
                </div>
            </slide>


        </carousel>
    </div>
</template>

<script>
    export default {
        name: "CatalogBoardSlider",
        data(){
            return {
                image: '/img/advert/becon.png'
            }
        }
    }
</script>
