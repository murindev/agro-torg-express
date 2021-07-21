<template>
    <section class="categoriesSlider">
        <div>

            <carousel
                    class="categoriesSlider-items"
                    :perPageCustom="[[768, 3], [1024, 4], [1200, 8]]"
                    :navigationEnabled="true"
                    navigationNextLabel="&rsaquo;"
                    navigationPrevLabel="&lsaquo;"
            >
                <slide v-for="slide in slides" :key="slide.id" v-if="slide.parent === 0">
                    <a target="_blank" :href="`/board/${slide.id}/`" class="categoriesSlider-item">
                        <i class="carousel-item-icon">
                            <img :src="'/storage/'+slide.icon"/>
                        </i>
                        <p>
                            {{slide.title_ru}}
                        </p>
                    </a>
                </slide>

            </carousel>


        </div>
    </section>
</template>

<script>
    export default {
        name: "slider",
        props: ['slides'],
        methods: {
            testClick(){
                console.log('llllllllll')
            }
        }
    }
</script>
