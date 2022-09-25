<template>
    <app-layout title="Dashboard">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                執行計畫
                <a class="float-right" :href="route('implementation_matter.create')">
                    <jet-button>新增</jet-button>
                </a>
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-8xl mx-auto base:px-6 lg:px-8">
                <div class="flex flex-col">
                    <div class="-my-2 base:-mx-6 lg:-mx-8">
                        <div class="py-2 align-middle inline-block min-w-full base:px-6 lg:px-8  max-h-screen-90">
                        <div class="shadow overflow-hidden border-b border-gray-200 base:rounded-lg">
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
                                            <el-input v-model="search" size="large" placeholder="搜尋簽呈編號" />
                                        </div>

                                    </div>
                                </div>
                            <el-table 
                            :data="rows.filter((data) =>
                                                        (new Date(data.created_at)).getTime() > this.value2[0].getTime() &&
                                                        (new Date(data.created_at)).getTime() < this.value2[1].getTime() &&
                                                        (!search || data.letter_num.toLowerCase().includes(search.toLowerCase())) &&
                                                        (!planfilter || data.plan_name.includes(planfilter))
                                                    )"
                            style="font-size: 18px"
                            height="80vh"
                            >
                                    <el-table-column fixed prop="sub" sortable label="執行計畫(分項)" width="auto" align="center">
                                        <template  #default="sc">
                                        <div class="text-base text-gray-900">{{sc.row.sub_item_id}}-{{sc.row.sub_num}}</div>
                                        <div class="text-base text-gray-900" v-if="sc.row.target!=''">-{{sc.row.target}}</div>
                                        <!-- <div class="text-sm text-gray-500" v-if="sc.row.assets_item">{{ sc.row.assets_item}} - {{ sc.row.fund_name}}</div> -->
                                        </template>
                                    </el-table-column>
                                        <el-table-column prop="plan_name" sortable label="經費來源" width="auto" align="left">
                                            <template  #default="pc">
                                                <div class="text-base text-gray-900">{{pc.row.plan_name}}</div>
                                                <div class="text-sm text-gray-500" v-if="pc.row.assets_item">{{ pc.row.assets_item}} - {{ pc.row.fund_name}}</div>
                                            </template>
                                        </el-table-column>
                                        <el-table-column prop="department" :filters="school_dep" :filter-method="filterdep" sortable label="申請人(申請處室)" align="center">
                                        <template #default="sc">
                                            <div class="text-base text-gray-900" v-if="sc.row.department" align="left">
                                                {{sc.row.department}}-{{sc.row.applicant}}
                                            </div>
                                            <div class="text-base text-gray-900" v-else  align="left">
                                                <div class="text-sm text-gray-500">
                                                    {{ sc.row.director }}
                                                </div>
                                            </div>
                                        </template>
                                        </el-table-column>
                                        <el-table-column prop="letter_num" sortable label="簽呈編號/主旨" align="center">
                                        <template #default="letter_content">
                                            <div class="ml-4">
                                                <div class="text-base font-medium text-gray-900" align="left">
                                                    {{letter_content.row.letter_num}}
                                                </div>
                                                <div class="text-sm text-gray-500"  v-html="letter_content.row.implementation_matter_name" align="left">
                                                </div>
                                            </div>
                                        </template>
                                        </el-table-column>
                                        <el-table-column prop="amount" sortable label="已核銷/總額" align="center">
                                            <template  #default="ac">
                                                <div class="text-base text-gray-900" align="left">
                                                    {{tothousand(ac.row.reimburse)}} / {{tothousand(ac.row.amount)}}
                                                </div>
                                                <div class="text-sm text-gray-500" align="left">
                                                    {{rate(ac.row.reimburse ,ac.row.amount)}} %
                                                </div>
                                            </template>
                                        </el-table-column>
                                        <el-table-column prop="created_at" sortable label="核銷中" :formatter="DateFormat">
                                            <template  #default="rc">
                                            <div class="text-base text-gray-900">{{tothousand(rc.row.estimated_amount)}} / {{tothousand(rc.row.amount)}}</div>
                                                <div class="text-sm text-gray-500">
                                                {{rate(rc.row.estimated_amount ,rc.row.amount)}} %
                                            </div>
                                            </template>
                                        </el-table-column>
                                        <el-table-column prop="reimburse" sortable label="執行率" align="center" max-height="30px">

                                            <template #default="money">
                                                    <el-progress type="circle" :percentage="rate(money.row.reimburse ,money.row.amount)" />
                                            </template>
                                        </el-table-column>
                                        <el-table-column prop="remark" sortable label="備註" align="center" />
                                        <el-table-column align="center">
                                        <template #default="scope">
                                            <a :href="route('implementation_matter.edit', scope.row.implementation_matter_id)" class="text-indigo-600 hover:text-indigo-900" v-if="scope.row.implementation_matter_id">修改</a>
                                        </template>
                                        </el-table-column>
                            </el-table>
                        </div>
                        </div>
                    </div>
                    </div>
            </div>
        </div>
    </app-layout>
</template>

<script>
    import { defineComponent } from 'vue'
    import JetButton from '@/Jetstream/Button.vue'
    import AppLayout from '@/Layouts/AppLayout.vue'
    import {ElTable} from 'element-plus'
    import {ElTableColumn} from 'element-plus'
    import {ElInput} from 'element-plus'
    import {ElTag} from 'element-plus'
    import {ElButton} from 'element-plus'
    import {ElDatePicker} from 'element-plus'
    import {ElProgress} from 'element-plus'
    export default defineComponent({
        components: {
            AppLayout,
            JetButton,
            ElButton,
            ElTable,
            ElProgress,
            ElInput,
            ElTag,
            ElDatePicker,
            ElTableColumn,
        },
        data() {
            return {
                filterdep(value,row){
                    return row.department === value
                },
                filterstatus(value,row){
                    console.log(row.status_id)
                    console.log(value)
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
            rate(a,b){
                if (isNaN(Math.round(a/b*10000)/100)||a===0||b===0)
                    return 0
                else
                    return Math.round(a/b*10000)/100
            },
            test(a){
                console.log(a)
            },
            tobr(text){
              if (text != undefined)
                return text.replace(/\n/g,'<br>')
            },
            handleNewLine(str) {
                if (str)
                    return str.replace(/.{10}\x01?/g,"$&</br>");
            },
            tothousand(num){
                if(num==0)
                    return 0
                else (num)
                    return (num || 0).toString().replace(/(\d)(?=(?:\d{3})+$)/g, '$1,');
            },
        },
        created(){
            if (this.rows.length > 1){
            let last = [this.rows[0].sub_item_id + '-' + this.rows[0].sub_num + this.rows[0].target,this.rows[0].sub_id];
            this.res=[];
            let data = [];
            let count = 1;
            let total=[0,0,0];
            this.deps.forEach(data=>
                this.school_dep.push(
                    {
                        text: data.department,
                        value: data.department,
                    })
            );
            this.rows.forEach((element,index) => {
                // console.log(this.rows[index])
                // console.log(typeof(element))
                // element.push({test:element.sub_item_id +'-'+element.sub_id});
                // if (element.sub_item_id  + '-' + this.rows[index].sub_num + this.rows[index].target == last[0] && element.sub_id == last[1]){
                //     data.push(element)
                //     total[0]+=parseInt(element.amount);
                //     total[1]+=parseInt(element.estimated_amount);
                //     total[2]+=parseInt(element.reimburse);
                //     count ++;
                // }
                // else{
                //     data.push({
                //         'amount' : total[0],
                //         'estimated_amount' : total[1],
                //         'reimburse' : total[2],
                //         'plan_name' : '合計',
                //     });
                //     this.res.push({
                //         'implementation_matter_name': last[0],
                //         'sub_strategy': last[1],
                //         'data': data,
                //         'count': count+1,
                //     })
                //     data=[]
                //     total=[parseInt(element.amount),parseInt(element.estimated_amount),parseInt(element.reimburse)];
                //     count=2
                //     data.push(element)
                //     last = [element.sub_item_id  + '-' + element.sub_num + element.target,element.sub_id];
                // }
                // if (index == this.rows.length-1){
                //     data.push({
                //         'amount' : total[0],
                //         'estimated_amount' : total[1],
                //         'reimburse' : total[2],
                //         'plan_name' : '合計',
                //     });
                //     this.res.push({
                //         'implementation_matter_name': last[0],
                //         'sub_strategy': last[1],
                //         'data': data,
                //         'count': count+1,
                //     })
                // }
                // console.log(this.res)
            });
        }
        },
    })
</script>
