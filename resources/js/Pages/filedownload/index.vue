<template>
    <app-layout title="資料匯出">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                資料匯出
                <!-- <a class="float-right" :href="route('subplan.create')" v-if="$page.props.permission.users.viewAny">
                    <jet-button>新增</jet-button>
                </a> -->
            </h2>
        </template>
        <div class="py-12">
            <div class="max-w-8xl mx-auto base:px-6 lg:px-8">
                <div class="flex flex-col">
                    <div class="-my-2 base:-mx-6 lg:-mx-8">
                        <div class="py-2 align-middle inline-block min-w-full base:px-6 lg:px-8">
                            <div class="shadow border-b border-gray-200 base:rounded-lg">
                                    <div class="flex flex-wrap py-4">
                                        <div class="flex-auto w-32">
                                            <div class="grid justify-items-stretch ...">
                                                <div class="justify-self-end ">
                                                    <el-button type="primary" v-on:click="insertfilter('110')" size="large" round>110年度</el-button>
                                                    <el-button type="primary" v-on:click="insertfilter('111')" size="large" round>111年度</el-button>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="flex-auto w-32">
                                            <div class="grid justify-items-stretch">
                                                <!-- <div class="justify-self-center ">
                                                    <el-date-picker
                                                    type="daterange"
                                                    align="right"
                                                    unlink-panels
                                                    v-model="value2"
                                                    range-separator="至"
                                                    start-placeholder="開始日期"
                                                    end-placeholder="結束日期"
                                                    :shortcuts="shortcuts"
                                                    :default-value="[new Date(2022,0,1), new Date()]"
                                                    :disabled-date="disabledDate"
                                                    size="large"/>
                                                </div> -->
                                                <div class="p-4 mt-4 justify-self-center">
                                                    <el-button class="pt-12" color="#626aef" @click="downloadfile()" type="primary" >下載</el-button>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="flex-auto w-32">
                                            <div class="py-2 align-middle inline-block min-w-full base:px-6 lg:px-8">
                                                <div class="grid justify-items-stretch">
                                                    <div class="grid justify-items-stretch">
                                                        <div class="justify-self-center ">
                                                            <!-- <el-input v-model="search" size="large" placeholder="搜尋請購單號" /> -->
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>  
                                        </div>
                                    </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </app-layout>
</template>

<script>
    import { defineComponent,computed } from 'vue'
    import JetButton from '@/Jetstream/Button.vue'
    import dateFormat, { masks } from "dateformat";
    import AppLayout from '@/Layouts/AppLayout.vue'
    import ElementPlus from 'element-plus'
    import {ElTable} from 'element-plus'
    import {ElTableColumn} from 'element-plus'
    import {ElInput} from 'element-plus'
    import {ElTag} from 'element-plus'
    import {ElButton} from 'element-plus'
    import {ElDatePicker} from 'element-plus'
    import 'element-plus/dist/index.css'
    import {
    TransitionRoot,
    TransitionChild,
    Dialog,
    DialogOverlay,
    DialogTitle,
    } from '@headlessui/vue'
    export default defineComponent({
        components: {
            AppLayout,
            ElementPlus,
            JetButton,
            dateFormat,
            ElButton,
            ElTable,
            ElInput,
            ElTag,
            ElDatePicker,
            ElTableColumn,
            TransitionRoot,
            TransitionChild,
            Dialog,
            DialogOverlay,
            DialogTitle,
        },
        data() {
            return {
                // filterdep(value,row){
                //     return row.department === value
                // },
                // filterstatus(value,row){
                //     return row.status_id === value
                // },
                // disabledDate(time) {
                //     return time.getTime() >= Date.now()
                // },
                // school_dep:[],
                // search:'',
                // planfilter:'',
                shortcuts: [{
                text: '今天',
                value: [new Date(), new Date()],
                },{
                text: '這個月',
                value: (() => {
                    const end = new Date()
                    const start = new Date(new Date().getFullYear(), new Date().getMonth())
                    return [start, end]
                })(),
                }, {
                text: '今年',
                value: (() => {
                    const end = new Date()
                    const start = new Date(new Date().getFullYear(), 0)
                    return [start, end]
                })(),
                }, {
                text: '最近六個月',
                value: (() => {
                    const end = new Date()
                    const start = new Date()
                    start.setMonth(start.getMonth() - 6)
                    return [start, end]
                })(),
                },{
                text: '去年',
                value: (() => {
                    const end = new Date(new Date().getFullYear()-1, 11,31)
                    const start = new Date(new Date().getFullYear()-1, 0)
                    return [start, end]
                })(),
                }],
                value2: [new Date(2022,0,1),new Date(2022,11,31)],
            };
        },
        props:['',''],
        methods:{
            // downloadfile(){
            //         axios.get(route('filedownload.download')).then(res => {
            //             // location.reload()
            //             console.log(res.data)
            //         })
            // }
        },
        created(){
            
            // this.planfilter='111'
            // this.deps.forEach(data=>
            //     this.school_dep.push(
            //         {
            //             text: data.department,
            //             value: data.department,
            //         })
            // );
            // let last = [this.rows[0].implementation_matter_name,this.rows[0].sub_strategy];
            // this.res=[];
            // let data = [];
            // let count = 1;
            // this.rows.forEach((element,index) => {
            //     element.sub = element.sub_item_id + '-' + element.sub_num + ' ' + element.target
            //     if (element.implementation_matter_name == last[0] && element.sub_strategy == last[1]){
            //         data.push(element)
            //         count ++;
            //     }
            //     else{
            //         this.res.push({
            //             'implementation_matter_name': last[0],
            //             'sub_strategy': last[1],
            //             'data': data,
            //             'count': count,
            //         })
            //         data=[]
            //         count=1
            //         data.push(element)
            //     }
            //     last = [element.implementation_matter_name,element.sub_strategy];
            //     if (index == this.rows.length-1){
            //         this.res.push({
            //             'implementation_matter_name': last[0],
            //             'sub_strategy': last[1],
            //             'data': data,
            //             'count': count,
            //         })
            //     }
            // },);
            
        }, 
        setup() {
            // const isOpen = ref(false)
            const FileDownload = require('js-file-download');
            return {
            //     isOpen,
            //     closeModal() {
            //         isOpen.value = false
            //     },
            //     opencheck(id) {
            //         isOpen.value = true
            //         this.checkid = id
            //     },
            
                    downloadfile(){
                            axios({
                                url: route('funddownload'),
                                method: 'GET',
                                responseType: 'blob', // Important
                                }).then((response) => {
                                    FileDownload(response.data, 'download.xlsx');
                                })
                    }
            //     checkwindow(){
            //         let aa = new FormData;
            //         aa.append('checkid', this.checkid);
            //         axios.post(route('check'),aa).then(res => {
            //         isOpen.value = false
            //         location.reload()
            //     })
            //     }
            }
        },
    })
</script>
