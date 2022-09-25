<template>
    <app-layout title="請購明細">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                請購明細
                <a class="float-right" :href="route('subplan.create')" v-if="$page.props.permission.users.viewAny">
                    <jet-button>新增</jet-button>
                </a>
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
                                        <div class="grid justify-items-stretch ...">
                                            <div class="justify-self-center ">
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
                                            </div>
                                    </div>
                                    </div>
                                    <div class="flex-auto w-32">
                                        <div class="grid justify-items-stretch ...">
                                            <el-input v-model="search" size="large" placeholder="搜尋請購單號" />
                                        </div>

                                    </div>
                                </div>
                            <el-table 
                            :data="rows.filter((data) =>
                                                        (new Date(data.created_at)).getTime() > this.value2[0].getTime() &&
                                                        (new Date(data.created_at)).getTime() < this.value2[1].getTime() &&
                                                        (!search || data.requisition_num.toLowerCase().includes(search.toLowerCase())) &&
                                                        (!planfilter || data.plan_name.includes(planfilter))
                                                    )"
                            :default-sort="{prop: 'created_at'}" style="font-size: 18px;width: 100%"
                            >
                                    <el-table-column prop="sub" sortable label="執行計畫(分項)" width="auto" align="center"/>
                                    
                                    <el-table-column prop="plan_name" sortable label="經費來源" width="auto" align="left">
                                        <template  #default="pc">
                                            <div class="text-gray-900">{{pc.row.plan_name}} - {{ pc.row.fund_name}}</div>
                                            <!-- <div class="text-sm text-gray-500" v-if="pc.row.assets_item">{{ pc.row.assets_item}} - {{ pc.row.fund_name}}</div> -->
                                        </template>
                                    </el-table-column>
                                    <!-- <el-table-column prop="plan_name" sortable label="經費來源" width="auto" align="center" /> -->
                                    <el-table-column prop="department" :filters="school_dep" width="auto" :filter-method="filterdep" sortable label="申請人(申請處室)" align="center" />
                                    <el-table-column prop="requisition_num" width="auto" sortable label="請購單號" align="center" />
                                    <el-table-column prop="amount" sortable :min-width="70" width="auto" label="核銷金額" align="center">
                                        <template  #default="tttt">
                                            {{tothousand(tttt.row.amount)}}
                                        </template>
                                    </el-table-column>
                                    <el-table-column prop="status_id" width="auto" :min-width="53" sortable label="核銷狀態"
                                    align="center">
                                        <template #default="scope">
                                            <el-tag
                                            style="font-size: 18px"
                                            size="large"
                                            type="danger"
                                            disable-transitions
                                            v-if="scope.row.status_id === 1"
                                            >未核銷</el-tag>
                                            <el-tag
                                            style="font-size: 18px"
                                            size="large"
                                            type="success"
                                            disable-transitions
                                            v-if="scope.row.status_id === 2"
                                            >已核銷</el-tag>
                                        </template>
                                    </el-table-column>
                                    <el-table-column prop="created_at" width="auto" sortable label="備註" :formatter="DateFormat" />
                                    <el-table-column prop="name" :min-width="33" sortable label="建立人" align="center" />
                                    <el-table-column align="center" width="auto">
                                    <template #default="scope">
                                        <a :href="route('subplan.show', scope.row.sub_plan_fund_detail_id)" class="text-indigo-600 hover:text-indigo-900">檢視</a>
                                        <a :href="route('subplan.edit', scope.row.sub_plan_fund_detail_id)" class="ml-2 text-indigo-600 hover:text-indigo-900" v-if="scope.row.status_id==1">修改</a>
                                        <a class="cursor-pointer ml-2 text-indigo-600 hover:text-indigo-900" @click="opencheck(scope.row.sub_plan_fund_detail_id)" v-if="scope.row.status_id==1 && $page.props.user.role=='admin'">核銷</a>
                                    </template>
                                    </el-table-column>
                            </el-table>
                        </div>
                        </div>
  <TransitionRoot appear :show="isOpen" as="template">
    <Dialog as="div" @close="closeModal">
      <div class="fixed inset-0 z-10 overflow-y-auto">
        <div class="min-h-screen px-4 text-center">
          <TransitionChild
            as="template"
            enter="duration-300 ease-out"
            enter-from="opacity-0"
            enter-to="opacity-100"
            leave="duration-200 ease-in"
            leave-from="opacity-100"
            leave-to="opacity-0"
          >
            <DialogOverlay class="fixed inset-0" />
          </TransitionChild>

          <span class="inline-block h-screen align-middle" aria-hidden="true">
            &#8203;
          </span>

          <TransitionChild
            as="template"
            enter="duration-300 ease-out"
            enter-from="opacity-0 scale-95"
            enter-to="opacity-100 scale-100"
            leave="duration-200 ease-in"
            leave-from="opacity-100 scale-100"
            leave-to="opacity-0 scale-95"
          >
            <div class="inline-block w-full max-w-sm p-6 my-8 overflow-hidden text-left align-middle transition-all transform bg-white shadow-xl rounded-2xl border-purple-400 border-4">
                <div class="flex items-center justify-between  justify-items-stretch">
                    <div class="w-0 flex-1 justify-self-auto grid justify-items-stretch">
                    <span class="flex p-2 m-auto justify-self-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-14 h-14 text-red-600 justify-items-center" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                        </svg>
                        <span class="flex text-2xl text-center items-center">
                        確定核銷?
                        </span>
                    </span>
                    </div>
                </div>
                <div class="flex items-center justify-between  justify-items-stretch">
                    <div class="w-0 flex-1 grid justify-items-stretch">
                    <span class="flex p-2 m-auto justify-self-end">
                        <div class="m-2 flex">
                            <div class="m-2 flex">
                            <button
                            type="button"
                            class="inline-flex justify-center px-4 py-2 text-base text-white font-black bg-red-600 border border-transparent rounded-md hover:bg-red-500 focus-visible:ring-2 focus-visible:ring-offset-2"
                            @click="closeModal">取消</button>
                        </div>
                        <div class="m-2 flex">
                        <button type="button" class="inline-flex justify-center px-4 py-2 text-base text-white font-black bg-indigo-500 border border-transparent rounded-md hover:bg-indigo-400 focus-visible:ring-2 focus-visible:ring-offset-2" @click="checkwindow()" >確定
                        </button>
                        </div>
                        </div>
                    </span>
                    </div>
                </div>
            </div>
          </TransitionChild>
        </div>
      </div>
    </Dialog>
  </TransitionRoot>
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
    import { ref } from 'vue'
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
                filterdep(value,row){
                    return row.department === value
                },
                filterstatus(value,row){
                    return row.status_id === value
                },
                disabledDate(time) {
                    return time.getTime() >= Date.now()
                },
                school_dep:[],
                search:'',
                planfilter:'',
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
        props:['rows','deps'],
        methods:{
            DateFormat(row,column){
                return dateFormat(row.created_at,'yyyy-mm-dd')
            },
            insertfilter(value){
                this.planfilter = value
            },
            handleNewLine(str) {
                if (str){
                    return str.replace(/(?:\r\n|\r|\n)/g,'<br />');
                }
            },
            handleNewLine1(str) {
                if (str)
                    return str.replace(/.{15}\x01?/g,"$&</br>");
            },
            tothousand(num){
                return (num || 0).toString().replace(/(\d)(?=(?:\d{3})+$)/g, '$1,');
            },
        },
        created(){
            
            this.planfilter='111'
            this.deps.forEach(data=>
                this.school_dep.push(
                    {
                        text: data.department,
                        value: data.department,
                    })
            );
            let last = [this.rows[0].implementation_matter_name,this.rows[0].sub_strategy];
            this.res=[];
            let data = [];
            let count = 1;
            this.rows.forEach((element,index) => {
                element.sub = element.sub_item_id + '-' + element.sub_num + ' ' + element.target
                if (element.implementation_matter_name == last[0] && element.sub_strategy == last[1]){
                    data.push(element)
                    count ++;
                }
                else{
                    this.res.push({
                        'implementation_matter_name': last[0],
                        'sub_strategy': last[1],
                        'data': data,
                        'count': count,
                    })
                    data=[]
                    count=1
                    data.push(element)
                }
                last = [element.implementation_matter_name,element.sub_strategy];
                if (index == this.rows.length-1){
                    this.res.push({
                        'implementation_matter_name': last[0],
                        'sub_strategy': last[1],
                        'data': data,
                        'count': count,
                    })
                }
            },);
            
        }, 
        setup() {
            const isOpen = ref(false)
            return {
                isOpen,
                closeModal() {
                    isOpen.value = false
                },
                opencheck(id) {
                    isOpen.value = true
                    this.checkid = id
                },
                checkwindow(){
                    let aa = new FormData;
                    aa.append('checkid', this.checkid);
                    axios.post(route('check'),aa).then(res => {
                    isOpen.value = false
                    location.reload()
                })
                }
            }
        },
    })
</script>