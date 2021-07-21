<template>
    <div>
        <div class="h-panel">
            <div class="h-panel-bar">
                <span class="h-panel-title">Fermer.ru</span>
                <div class="h-panel-right">
                    <Button
                            v-if="currentPage === null"
                            color="primary" icon="h-icon-right" @click="start()">Старт
                    </Button>
                    <Button
                            v-else-if="currentPage > startPage && currentPage <= endPage"
                            color="red" icon="h-icon-down" @click="stop = true">Стоп
                    </Button>
                    <Button
                            v-else-if="currentPage > endPage"
                            color="blue" icon="h-icon-completed">Готово
                    </Button>
                </div>
            </div>
            <div class="m-row">
                <div class="m-cel w600">
                    <div class="h-panel-bar ">
                        <span class="h-panel-label">Категория:</span>
                        <i class="h-split"></i>
                        <Radio v-model="condition" :datas="conditions"></Radio>
                    </div>
                    <div class="h-panel-bar">
                        <span class="h-panel-label">№ начальной страницы:</span>
                        <i class="h-split"></i>
                        <input type="text" v-model="startPage" @focusout="currentPage = null"
                               style="display: inline-block; width: 60px;">
                        <i class="h-split"></i>
                        <i>Первая страница считается с 0</i>
                    </div>
                    <div class="h-panel-bar">
                        <span class="h-panel-label">№ последней страницы:</span>
                        <i class="h-split"></i>
                        <input type="text" v-model="endPage" @focusout="currentPage = null"
                               style="display: inline-block; width: 60px;">
                    </div>
                </div>
                <div class="m-cel rest">
                    <div class="tablo">
                        {{currentPage}}
                    </div>

                </div>

            </div>


            <div class="h-panel-bar">
                <span>Не парсить:</span>
                <i class="h-split"></i>
                <Select v-model="select" :datas="geo" :multiple="true" keyName="key" titleName="title"
                        style="min-width: 400px; display: inline-block;">
                    <template slot-scope="{item}" slot="item">
                        <span>{{item.title}}</span>
                    </template>
                </Select>


            </div>
            <div class="h-panel-body">
                <div v-for="(val,key) in catalogData">{{key}}: {{val}}</div>
            </div>
        </div>
    </div>

</template>

<script>
    export default {
        name: "FermerRu",
        props: ['geo'],
        data() {
            return {
                domen: 'https://fermer.ru',
                conditions: [
                    {title: 'Продажа', key: '/gazeta?page='},
                    {title: 'Покупка', key: '/spros?page='},
                ],
                condition: '/gazeta?page=',
                select: ['Московская область', 'Москва'],
                startPage: 0,
                endPage: 0,
                currentPage: null,
                adItems: [],
                counter: [],
                catalogData: [],
                catalogErrors: [],
                stop: false,
            };
        },
        methods: {

            async start() {
                if (this.currentPage > this.endPage || this.stop) {
                    return false
                } else {
                    this.counter = []
                    this.currentPage = await this.currentPage === null ? this.startPage : +1
                    await this.getCatalog(this.currentPage)
                }
            },
            async getCatalog(i) {
                if (this.currentPage > this.endPage || this.stop) {
                    return false
                }

                await axios.post('/admin/parsers/fermer', {
                    url: this.condition + i,
                    exclude: this.select.join(',')
                }).then((response) => {
                    this.$set(this.$data, 'catalogData', response.data)
                    this.$set(this.$data, 'catalogErrors', response.errors)
                }).then(() => this.getItems())
            },

            async getItems() {
                if (this.currentPage > this.endPage || this.stop) {
                    return false
                }
                await axios.get('/admin/parsers/fermer/new-page')
                    .then((response) => {
                        this.$set(this.$data, 'adItems', response.data)
                    })
                    .then(() => {
                        this.parsePage()
                    })
            },

            async parsePage() {
                if (this.currentPage > this.endPage || this.stop) {
                    return false
                }
                await this.adItems.forEach(i => {
                    axios.post('/admin/parsers/fermer/page', {
                        url: this.domen + i.link,
                        link: i.link
                    })
                        .then((response) => {
                            let index = this.adItems.findIndex(i => i.link === response.data.link)
                            this.adItems.splice(index, 1)
                        })
                        .then(() => this.checkPages())
                })
            },

            checkPages() {
                if (this.currentPage > this.endPage || this.stop) {
                    return false
                }
                if (this.adItems.length === 0 && this.currentPage <= this.endPage) {
                    this.start()
                } else {
                    this.currentPage++
                }
            }

        },


        async mounted() {
            // await this.fillSelect()

        }
    }
</script>
