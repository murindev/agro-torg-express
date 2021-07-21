<template>
    <div>
        <div class="h-panel">
            <div class="h-panel-bar">
                <span class="h-panel-title">Fermer.ru</span>
                <div class="h-panel-right">

                    <input type="checkbox" v-model="isTesting">

                    <template v-if="currentPage <= endPage">

                        <Button
                                v-if="currentPage === null || stop"
                                color="primary" icon="h-icon-right" @click="switcher(false)">Старт
                        </Button>

                        <Button
                                v-else-if="currentPage >= startPage && currentPage <= endPage || !stop"
                                color="red" icon="h-icon-down" @click="switcher(true)">Пауза
                        </Button>

                    </template>
                    <template v-else>
                        <!--         v-else-if="currentPage > endPage"-->
                        <Button color="blue" icon="h-icon-completed">Готово</Button>
                    </template>

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
                        <table>

                            <thead>
                            <tr>
                                <th colspan="4" class="site">Текущая страница каталога fermer.ru</th>
                                <th colspan="2"  class="base">База</th>
                            </tr>
                            <tr>
                                <th>Страница</th>
                                <th>Кол-во обьявлений</th>
                                <th>Удачно</th>
                                <th>С ошибками</th>
                                <th>Всего удачно</th>
                                <th>Все</th>
                            </tr>
                            </thead>

                            <tbody>
                            <tr>
                                <td>{{currentPage}}</td>
                                <td>{{catalogParsed}}</td>
                                <td>{{counter_success}}</td>
                                <td>{{counter_errors}}</td>
                                <td>{{parsed}}</td>
                                <td>{{all}}</td>
                            </tr>
                            </tbody>

                        </table>


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
                <!--                <div v-for="(val,key) in catalogData">{{key}}: {{val}}</div>-->
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
                counter: 0,
                counter_success: 0,
                counter_errors: 0,
                catalogData: [],
                catalogErrors: [],
                stop: true,
                // pause: false,
                isTesting: true,
                //------------
                all: null,
                parsed: null,
                catalogParsed: 0
            };
        },
        methods: {

           async switcher(state) {
                this.stop = await state
                await this.start()
            },

            async start() {
                if (this.currentPage > this.endPage || this.stop) {
                    return false
                } else {
                    if(await this.currentPage === null){
                        this.currentPage =  this.startPage
                    } else {
                        this.currentPage++
                    }
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
                    console.log('response', response);
                    this.counter = response.data.arrData.length
                    this.$set(this.$data, 'catalogParsed', response.data.parsed)
                    this.$set(this.$data, 'counter_success', 0)
                    this.$set(this.$data, 'catalogData', response.data.data)
                    this.$set(this.$data, 'catalogErrors', response.data.errors)
                    if (this.isTesting && response.data.errors.length) {
                        this.stop = true
                    } else {
                        this.getItem()
                    }
                })
            },

            async getItem() {
                if (this.currentPage > this.endPage || this.stop) {
                    return false
                }
                await axios.get('/admin/parsers/fermer/new-page')
                    .then((response) => {
                        this.all = response.data.all
                        this.parsed = response.data.parsed
                        this.parsePage(response.data.next)
                    })
            },

            async parsePage(next) {
                if (this.currentPage > this.endPage || this.stop) {
                    return false
                }

                if (next !== 'end') {
                    axios.post('/admin/parsers/fermer/page', {
                        url: this.domen + next.link,
                        link: next.link
                    }).then((response) => {
                        if (this.isTesting && response.data.errors.length) {
                            this.stop = true
                            this.counter_errors++
                        } else {
                            this.getItem()
                            this.counter_success++
                        }
                    })
                } else {
                    this.checkPages()
                }

            },

            checkPages() {
                // if (this.currentPage > this.endPage || this.stop) {
                //     return false
                // }
                if (this.currentPage <= this.endPage) {
                    this.start()
                } else {
                    this.currentPage++
                }
            }

        },


        async mounted() {
            await axios.get('/admin/parsers/fermer/new-page')
                .then((response) => {
                    this.all = response.data.all
                    this.parsed = response.data.parsed
                    this.parsePage(response.data.next)
                })

        }
    }
</script>
