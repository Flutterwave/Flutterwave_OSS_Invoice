(window["webpackJsonp"]=window["webpackJsonp"]||[]).push([[11],{"93e5":function(t,e,s){"use strict";s.r(e);var a=function(){var t=this,e=t.$createElement,s=t._self._c||e;return s("div",{staticClass:"assets-main q-pa-xl"},[s("div",{staticClass:"row",staticStyle:{"margin-bottom":"1em"}},[s("q-expansion-item",{staticClass:"filter",attrs:{"default-opened":"",icon:"fas fa-filter",label:"Filter"}},[s("div",{staticClass:"row q-gutter-md"},[s("q-input",{attrs:{clearable:"",label:"Title"},on:{input:function(e){t.filter.title.length>=t.minFilterLength&&t.filterAssets()}},model:{value:t.filter.title,callback:function(e){t.$set(t.filter,"title",e)},expression:"filter.title"}}),s("q-select",{attrs:{options:t.clients,"emit-value":"",label:"Client","map-options":""},on:{input:t.filterAssets},model:{value:t.filter.client,callback:function(e){t.$set(t.filter,"client",e)},expression:"filter.client"}}),s("q-input",{attrs:{clearable:"",label:"Lender ID"},on:{input:function(e){t.filter.investor_id.length>=2&&/^\d+$/.test(t.filter.investor_id)&&t.filterAssets()}},model:{value:t.filter.investor_id,callback:function(e){t.$set(t.filter,"investor_id",e)},expression:"filter.investor_id"}}),s("q-select",{attrs:{options:[{label:"",value:""},{label:"Monthly",value:"MONTHLY"},{label:"Lump Sum",value:"LUMP"}],"emit-value":"",label:"Payback Type","map-options":""},on:{input:t.filterAssets},model:{value:t.filter.payback_type,callback:function(e){t.$set(t.filter,"payback_type",e)},expression:"filter.payback_type"}}),s("q-select",{attrs:{options:[{label:"",value:""},{label:"Week",value:"WEEK"},{label:"Month",value:"MONTH"},{label:"Year",value:"YEAR"}],"emit-value":"",label:"Tenure Type","map-options":""},on:{input:t.filterAssets},model:{value:t.filter.tenure_type,callback:function(e){t.$set(t.filter,"tenure_type",e)},expression:"filter.tenure_type"}}),s("q-select",{attrs:{options:t.categories,"emit-value":"",label:"Category","map-options":""},on:{input:t.filterAssets},model:{value:t.filter.category,callback:function(e){t.$set(t.filter,"category",e)},expression:"filter.category"}}),s("q-select",{attrs:{options:[{label:"",value:""},{label:"Yes",value:1},{label:"No",value:0}],"emit-value":"",label:"Active","map-options":""},on:{input:t.filterAssets},model:{value:t.filter.active,callback:function(e){t.$set(t.filter,"active",e)},expression:"filter.active"}}),s("q-select",{attrs:{options:[{label:"",value:""},{label:"Yes",value:1},{label:"No",value:0}],"emit-value":"",label:"Discontinued?","map-options":""},on:{input:t.filterAssets},model:{value:t.filter.discontinued,callback:function(e){t.$set(t.filter,"discontinued",e)},expression:"filter.discontinued"}}),s("q-select",{attrs:{options:[{label:"",value:""},{label:"Yes",value:1},{label:"No",value:0}],"emit-value":"",label:"Funded?","map-options":""},on:{input:t.filterAssets},model:{value:t.filter.has_investments,callback:function(e){t.$set(t.filter,"has_investments",e)},expression:"filter.has_investments"}}),s("q-select",{attrs:{options:[{label:"",value:""},{label:"Yes",value:"1"},{label:"No",value:"0"}],"emit-value":"",label:"Repaid?","map-options":""},on:{input:t.filterAssets},model:{value:t.filter.paid_back,callback:function(e){t.$set(t.filter,"paid_back",e)},expression:"filter.paid_back"}}),s("q-input",{attrs:{clearable:"",hint:"Exactly from this date",label:"Date From"},model:{value:t.filter.date_range.from,callback:function(e){t.$set(t.filter.date_range,"from",e)},expression:"filter.date_range.from"}},[s("q-popup-proxy",{ref:"dateFrom",attrs:{"transition-hide":"scale","transition-show":"scale"}},[s("q-date",{attrs:{mask:"DD-MM-YYYY"},on:{input:function(){t.$refs.dateFrom.hide(),t.filterAssets()}},model:{value:t.filter.date_range.from,callback:function(e){t.$set(t.filter.date_range,"from",e)},expression:"filter.date_range.from"}})],1)],1),s("q-input",{attrs:{clearable:"",hint:"Exactly to this date",label:"Date To"},model:{value:t.filter.date_range.to,callback:function(e){t.$set(t.filter.date_range,"to",e)},expression:"filter.date_range.to"}},[s("q-popup-proxy",{ref:"dateTo",attrs:{"transition-hide":"scale","transition-show":"scale"}},[s("q-date",{attrs:{mask:"DD-MM-YYYY"},on:{input:function(){t.$refs.dateTo.hide(),t.filterAssets()}},model:{value:t.filter.date_range.to,callback:function(e){t.$set(t.filter.date_range,"to",e)},expression:"filter.date_range.to"}})],1)],1)],1)])],1),t.assetsData.length?s("div",{staticClass:"row justify-end"},[s("span",{staticClass:"col-sm-5"}),s("q-select",{staticClass:"col-sm-2",staticStyle:{"font-size":"12px"},attrs:{options:[{label:"50 per page",value:"50"},{label:"100 per page",value:"100"},{label:"200 per page",value:"200"},{label:"500 per page",value:"500"},{label:"1000 per page",value:"1000"}],dense:"","emit-value":"","map-options":""},on:{input:t.filterAssets},model:{value:t.filter.per_page,callback:function(e){t.$set(t.filter,"per_page",e)},expression:"filter.per_page"}}),s("span",{staticClass:"col-sm-1"}),s("span",{staticClass:" col-sm-2",staticStyle:{"font-weight":"lighter",color:"gray","font-size":"12px","padding-top":"14px"}},[t._v(t._s(t.entries.to)+" out of\n                "+t._s(t.entries.total))])],1):t._e(),s("div",{staticClass:"row justify-center",staticStyle:{"margin-top":"30px"}},[t._l(t.assetsData,(function(e,a){return[s("q-card",{class:"col-md-3 col-sm-4 q-ma-md shadow-1 "+(e.paid_back?"bg-blue-1":e.active&&e.discontinue?"bg-orange-1":e.discontinue?"bg-grey-4":e.active?"bg-green-1":""),attrs:{title:e.paid_back?"Repaid":e.active&&e.discontinue?"Sold out but visible to lenders":e.discontinue?"Inactive and not visible to lenders":"Active and visible to lenders",inline:"",square:""}},[e.investments_count>0?s("label",{staticClass:"pull-right",staticStyle:{"background-color":"#004731",color:"whitesmoke","font-size":"12px",padding:"3px 7px",position:"relative",top:"-5px",left:"5px",cursor:"pointer"},attrs:{title:"Number of investments"},on:{click:function(s){return t.gotoLenders(e.id)}}},[t._v("\n                    "+t._s(e.investments_count))]):t._e(),e.guaranteed?s("i",{staticClass:"fa fa-star text-grey tag",attrs:{title:"Guaranteed"}}):t._e(),s("q-card-section",{style:e.investments_count?"":"margin-top: 10px"},[s("span",{staticClass:"card-title"},[t._v(t._s(e.title))]),s("div",{staticClass:"card-subtitle",staticStyle:{"font-size":"16px"}},[t._v(t._s(t._f("firstCaps")(e.client_info.username))+"\n                        "),s("br"),s("small",[t._v("\n                            ₦"+t._s(t._f("formatAmount")(e.amount))+" |\n                            "+t._s(e.tenure)+t._s(e.tenure_type.charAt(0))+" |\n                            "+t._s(e.interest_rate)+"%\n                        ")])])]),s("q-card-actions",{staticClass:"justify-center"},[s("q-btn",{directives:[{name:"ripple",rawName:"v-ripple"}],staticStyle:{color:"darkgrey"},attrs:{flat:"",icon:"fas fa-eye",label:"VIEW"},on:{click:function(s){return t.showInfoModal(e)}}})],1)],1)]}))],2),s("div",[t.assetInfo?s("q-dialog",{on:{hide:t.closeModal},model:{value:t.infoModal,callback:function(e){t.infoModal=e},expression:"infoModal"}},[s("q-card",{staticStyle:{width:"900px","max-width":"80vw"}},[s("q-card-section",[s("q-btn",{staticClass:"float-right",attrs:{flat:"",icon:"close",size:"sm"},on:{click:t.closeModal}})],1),s("q-card-section",[s("div",{staticStyle:{margin:"1em 2em 2em"}},[s("div",{staticClass:"text-center",staticStyle:{"margin-bottom":"2em"}},[s("h4",{staticStyle:{"font-family":"'Avenir Next Thin', sans-serif","margin-bottom":"5px","margin-top":"0","font-weight":"lighter"}},[t._v("\n                                "+t._s(t.assetInfo.title))]),s("div",{staticClass:"text-small",staticStyle:{color:"lightgrey"}},[t._v("\n                                "+t._s(t._f("moment")(t.assetInfo.date_created,"MMM Do YYYY, h:mm:ss A"))+"\n                            ")])]),s("div",{staticClass:"asset-info"},[s("div",{staticClass:"row gutter-sm"},[s("div",{staticClass:"col-md-3 col-sm-6"},[s("strong",[t._v("Client")]),s("p",[t._v(t._s(t._f("firstCaps")(t.assetInfo.client_info.username)))])]),s("div",{staticClass:"col-md-3 col-sm-6"},[s("strong",[t._v("Amount per Unit")]),s("p",[t._v("₦"+t._s(t._f("formatAmount")(t.assetInfo.amount)))])]),s("div",{staticClass:"col-md-3 col-sm-6"},[s("strong",[t._v("Interest Rate")]),s("p",[t._v(t._s(t.assetInfo.interest_rate)+"%")])]),s("div",{staticClass:"col-md-3 col-sm-6"},[s("strong",[t._v("Tenure")]),s("p",[t._v(t._s(t.assetInfo.tenure)+" "+t._s(t.assetInfo.tenure<2?t.assetInfo.tenure_type:t.assetInfo.tenure_type.toString().toLowerCase()+"s"))])]),s("div",{staticClass:"col-md-3 col-sm-6"},[s("strong",[t._v("Payback per Unit")]),s("p",[t._v("₦"+t._s(t._f("formatAmount")(t.assetInfo.payback_due)))])]),s("div",{staticClass:"col-md-3 col-sm-6"},[s("strong",[t._v("Payback Type")]),s("p",[t._v(t._s(t._f("firstCaps")(t.assetInfo.payback_type)))])]),s("div",{staticClass:"col-md-3 col-sm-6"},[s("strong",[t._v("Fully Paid")]),s("p",[t._v(t._s(1===t.assetInfo.paid_back?"Yes":"No"))])]),s("div",{staticClass:"col-md-3 col-sm-6"},[s("strong",[t._v("Category")]),s("p",[t._v(t._s(t.assetInfo.category.name))])]),s("div",{staticClass:"col-md-3 col-sm-6"},[s("strong",[t._v("Total Units")]),s("p",[t._v(t._s(t.assetInfo.total_units))])]),s("div",{staticClass:"col-md-3 col-sm-6"},[s("strong",[t._v("Remaining Units")]),s("p",[t._v(t._s(t.assetInfo.remaining_units))])]),s("div",{staticClass:"col-md-3 col-sm-6"},[s("strong",[t._v("Active")]),s("p",[t._v(t._s(1===t.assetInfo.active?"Yes":"No"))])]),s("div",{staticClass:"col-md-3 col-sm-6"},[s("strong",[t._v("Discontinued")]),s("p",[t._v(t._s(1===t.assetInfo.discontinue?"Yes":"No"))])]),s("div",{staticClass:"col-sm-12"},[s("strong",[t._v("Description")]),s("p",{domProps:{innerHTML:t._s(t.assetInfo.write_up)}})])])]),s("div",{staticClass:"row justify-center",staticStyle:{"margin-top":"10px"}},[s("div",{staticClass:"col-sm-4 text-center"},[0===t.assetInfo.active?s("q-btn",{directives:[{name:"ripple",rawName:"v-ripple"}],attrs:{color:"positive",flat:"",label:"MAKE ACTIVE"},on:{click:function(e){return t.setActive(t.assetInfo.id,"active")}}}):s("q-btn",{directives:[{name:"ripple",rawName:"v-ripple"}],attrs:{color:"orange",flat:"",label:"MAKE INACTIVE"},on:{click:function(e){return t.setActive(t.assetInfo.id,"inactive")}}})],1),s("div",{staticClass:"col-sm-4 text-center"},[0===t.assetInfo.discontinue?s("q-btn",{directives:[{name:"ripple",rawName:"v-ripple"}],attrs:{color:"orange",flat:"",label:"DISCONTINUE"},on:{click:function(e){return t.setDiscontinue(t.assetInfo.id,"discontinue")}}}):s("q-btn",{directives:[{name:"ripple",rawName:"v-ripple"}],attrs:{color:"positive",flat:"",label:"CONTINUE"},on:{click:function(e){return t.setDiscontinue(t.assetInfo.id,"continue")}}})],1),1===t.assetInfo.discontinue&&0===t.assetInfo.paid_back&&t.$can("asset-repayment")?s("div",{staticClass:"col-sm-4 text-center"},[s("q-btn",{directives:[{name:"ripple",rawName:"v-ripple"}],attrs:{color:"positive",flat:"",label:"CONFIRM PAYBACK"},on:{click:function(e){return t.confirmPayback(t.assetInfo.id)}}})],1):t._e()]),s("div",{staticClass:"row",staticStyle:{"margin-top":"30px"}},[s("div",{staticClass:"col"},[s("q-list",{attrs:{"no-border":"",separator:""}},[s("q-expansion-item",{ref:"investments_collapsible",attrs:{disable:0===t.assetInfo.investments_count,group:"info-tabs",icon:"fas fa-money-bill-alt",label:"Investments"},model:{value:t.tabs.investments,callback:function(e){t.$set(t.tabs,"investments",e)},expression:"tabs.investments"}},["investments"in t.assetInfo?s("div",[s("json-excel",{staticClass:"row justify-end",attrs:{data:t.assetInfo.investments,fields:t.investments_csv,name:t.assetInfo.title+".csv",type:"csv"}},[s("q-btn",{staticClass:"no-shadow",staticStyle:{"-webkit-border-radius":"2px","border-radius":"2px"},attrs:{color:"secondary",icon:"fas fa-save",label:"Export",size:"sm",unelevated:""}})],1),s("div",{staticClass:"row"},[s("table",{staticClass:"q-table col-sm-12"},[s("thead",[s("tr",[s("th",[t._v("LENDER ID")]),s("th",[t._v("USERNAME")]),s("th",[t._v("UNITS")]),s("th",[t._v("AMOUNT IN")]),s("th",[t._v("AMT. EXPECTED")]),s("th",[t._v("DATE")])])]),s("tbody",t._l(t.assetInfo.investments,(function(e,a){return s("tr",[s("td",{staticClass:"text-center"},[t._v(t._s(e.investor_id))]),s("td",{staticClass:"text-center"},[t._v(t._s(e.lender.username))]),s("td",{staticClass:"text-center"},[t._v(t._s(e.no_of_units))]),s("td",{staticClass:"text-center"},[t._v("₦"+t._s(t._f("formatAmount")(e.amount_in))+"\n                                                        ")]),s("td",{staticClass:"text-center"},[t._v("₦"+t._s(t._f("formatAmount")(e.amount_expected))+"\n                                                        ")]),s("td",{staticClass:"text-center"},[t._v("\n                                                            "+t._s(t._f("moment")(e.date_created,"MMM Do, YYYY"))+"\n                                                        ")])])})),0)])])],1):s("div",{staticClass:"row justify-center"},[s("q-spinner-puff",{staticStyle:{"margin-top":"2em"},attrs:{slot:"message",size:40,color:"primary"},slot:"message"})],1)]),s("q-expansion-item",{ref:"paybacks_collapsible",attrs:{disable:0===t.assetInfo.investments_count,group:"info-tabs",icon:"fas fa-calendar-alt",label:"Paybacks"},model:{value:t.tabs.paybacks,callback:function(e){t.$set(t.tabs,"paybacks",e)},expression:"tabs.paybacks"}},["paybacks"in t.assetInfo?s("div",[s("div",{staticClass:"row"},[s("table",{staticClass:"q-table col-sm-12"},[s("thead",[s("tr",[s("th",[t._v("DATE")]),s("th",[t._v("STATUS")])])]),s("tbody",t._l(t.assetInfo.paybacks,(function(e,a){return s("tr",{style:{"background-color":1===e.success?"#e5f1e6":"",color:1===e.success?"#4CAF50":""}},[s("td",{staticClass:"text-center"},[t._v("\n                                                            "+t._s(t._f("moment")(e.set_time,"MMM Do, YYYY"))+"\n                                                        ")]),s("td",{staticClass:"text-center text-bold",staticStyle:{"font-size":".7em","font-weight":"bold"}},[t._v("\n                                                            "+t._s(1===e.success?"SUCCESS":t.$moment(e.set_time)>t.$moment()?"PENDING":"DUE")+"\n                                                        ")])])})),0)])])]):s("div",{staticClass:"row justify-center"},[s("q-spinner-puff",{staticStyle:{"margin-top":"2em"},attrs:{slot:"message",size:40,color:"primary"},slot:"message"})],1)])],1)],1)])])])],1)],1):t._e()],1),t.assetsData.length<t.entries.total?s("div",{staticClass:"row justify-center"},[s("q-infinite-scroll",{attrs:{handler:t.refresher,offset:300}},[s("q-spinner-puff",{staticStyle:{"margin-top":"30px"},attrs:{slot:"message",size:40,color:"primary"},slot:"message"})],1)],1):t._e()])},i=[],n=(s("6b54"),s("a481"),s("967e")),o=s.n(n),r=s("4db1"),l=s.n(r),c=(s("96cf"),s("fa84")),f=s.n(c),u=(s("ac6a"),s("cadf"),s("06db"),s("456d"),s("b178")),p=s("1bdd"),d={name:"Assets",meta:function(){return{title:"Assets"}},components:{JsonExcel:p["a"]},data:function(){var t=this;return{activeNames:["1"],filter:{title:"",client:parseInt(this.$route.query.client_id)||"",investor_id:this.$route.query.investor_id||"",payback_type:"",paid_back:this.$route.query.repaid||"",tenure_type:"",category:parseInt(this.$route.query.category)||"",active:"",discontinued:"",has_investments:"",date_range:{from:"",to:""},page:1,per_page:"50"},clients:[{label:"",value:""}],categories:[{label:"",value:""}],assetsData:[],assetInfo:"",tabs:{investments:!1,paybacks:!1},investments_csv:{"Asset ID":"asset.title","Investor ID":"investor_id","Investor Name":{field:"lender",callback:function(e){return t.firstCaps(e.f_name)+" "+t.firstCaps(e.l_name)}},"Amount Invested":"amount_in","Amount Expected":"amount_expected","Amount Paid":"amount_returned","No. of Units":"no_of_units"},entries:{to:"",total:""},minFilterLength:3,infoModal:!1}},computed:{},created:function(){this.fetchFilterOptions(),Object.keys(this.$route.query).length&&this.filterAssets(),this.filterAssets()},methods:{fetchFilterOptions:function(){var t=this;return f()(o.a.mark((function e(){var s,a,i;return o.a.wrap((function(e){while(1)switch(e.prev=e.next){case 0:return e.prev=0,e.next=3,t.$axios.get("assets/fetchFilterOptions");case 3:s=e.sent,s.data.status&&((a=t.clients).push.apply(a,l()(s.data.clients)),(i=t.categories).push.apply(i,l()(s.data.categories))),e.next=11;break;case 7:e.prev=7,e.t0=e["catch"](0),t.showAlert("negative","Error fetching filter options"),t.$nprogress.done();case 11:case"end":return e.stop()}}),e,null,[[0,7]])})))()},fetchInvestments:function(){var t=this;return f()(o.a.mark((function e(){var s;return o.a.wrap((function(e){while(1)switch(e.prev=e.next){case 0:if("investments"in t.assetInfo){e.next=12;break}return e.prev=1,e.next=4,t.$axios.get("assets/fetchInvestments/".concat(t.assetInfo.id));case 4:s=e.sent,s.data.status&&(t.$set(t.assetInfo,"investments",s.data.investments),t.$set(t.assetInfo,"paybacks",s.data.paybacks)),e.next=12;break;case 8:e.prev=8,e.t0=e["catch"](1),t.showAlert("negative","Error fetching filter options"),t.$nprogress.done();case 12:case"end":return e.stop()}}),e,null,[[1,8]])})))()},filterAssets:Object(u["e"])(f()(o.a.mark((function t(){var e;return o.a.wrap((function(t){while(1)switch(t.prev=t.next){case 0:return this.filter.page=1,t.prev=1,t.next=4,this.$axios.get("assets/filter",{params:this.filter});case 4:e=t.sent,this.assetsData=e.data.data,this.entries.to=e.data.to,this.entries.total=e.data.total,t.next=13;break;case 10:t.prev=10,t.t0=t["catch"](1),console.error(t.t0);case 13:case"end":return t.stop()}}),t,this,[[1,10]])}))),1e3),refresher:function(t,e){var s=this;return f()(o.a.mark((function t(){var a,i;return o.a.wrap((function(t){while(1)switch(t.prev=t.next){case 0:return s.filter.page++,t.prev=1,t.next=4,s.$axios.get("assets/filter",{params:s.filter});case 4:i=t.sent,(a=s.assetsData).push.apply(a,l()(i.data.data)),s.entries.to=i.data.to,s.entries.total=i.data.total,e(),t.next=15;break;case 11:t.prev=11,t.t0=t["catch"](1),e(),console.error(t.t0);case 15:case"end":return t.stop()}}),t,null,[[1,11]])})))()},showInfoModal:function(t){this.assetInfo=t,this.infoModal=!0,this.fetchInvestments()},closeModal:function(){this.infoModal=!1,this.$refs.investments_collapsible.hide(),this.assetInfo=""},gotoLenders:function(t,e){},setActive:function(t,e){var s=this;this.$q.dialog({title:"Confirm",message:"Are you sure you want to do this?",ok:"Proceed",cancel:"Cancel"}).onOk(f()(o.a.mark((function a(){var i;return o.a.wrap((function(a){while(1)switch(a.prev=a.next){case 0:return a.prev=0,a.next=3,s.$axios.post("assets/setActive",{asset_id:t,action:e});case 3:i=a.sent,i.data&&("active"===e?(s.showAlert("positive","Asset is now displayed for investing"),s.assetInfo.active=1):(s.showAlert("positive","Asset now withdrawn for investing"),s.assetInfo.active=0)),a.next=10;break;case 7:a.prev=7,a.t0=a["catch"](0),a.t0.response.data&&(s.showAlert("negative","Operation error occurred"),console.error(a.t0));case 10:case"end":return a.stop()}}),a,null,[[0,7]])}))))},setDiscontinue:function(t,e){var s=this;this.$q.dialog({title:"Confirm",message:"Are you sure you want to do this?",ok:"Proceed",cancel:"Cancel"}).onOk(f()(o.a.mark((function a(){var i;return o.a.wrap((function(a){while(1)switch(a.prev=a.next){case 0:return a.prev=0,a.next=3,s.$axios.post("assets/setDiscontinue",{asset_id:t,action:e});case 3:i=a.sent,i.data.status&&("discontinue"===e?(s.showAlert("positive","Asset discontinued successfully"),s.assetInfo.discontinue=1):(s.showAlert("positive","Asset marked as valid successfully"),s.assetInfo.discontinue=0)),a.next=10;break;case 7:a.prev=7,a.t0=a["catch"](0),a.t0.response.data&&(s.showAlert("negative","Operation error occurred"),console.error(a.t0));case 10:case"end":return a.stop()}}),a,null,[[0,7]])}))))},confirmPayback:function(t){var e=this;this.$q.dialog({title:"Confirm",message:"This operation is quite sensitive. Are you sure you really want to do this?",ok:"Proceed",cancel:"Cancel"}).onOk(f()(o.a.mark((function s(){var a;return o.a.wrap((function(s){while(1)switch(s.prev=s.next){case 0:return s.prev=0,s.next=3,e.$axios.post("assets/confirmPayback",{asset_id:t});case 3:a=s.sent,a.data.status&&(e.assetInfo.paid_back=a.data.repaid,e.showAlert("positive","Payback confirmed successfully")),s.next=10;break;case 7:s.prev=7,s.t0=s["catch"](0),s.t0.response.data&&(e.showAlert("negative","Operation error occurred"),console.error(s.t0));case 10:case"end":return s.stop()}}),s,null,[[0,7]])}))))},resetFilterData:function(){this.filter.asset_id="",this.filter.f_name="",this.filter.l_name="",this.filter.username="",this.filter.phone="",this.filter.email=""},showAlert:function(t,e){this.$q.notify({type:t,message:e,position:"top-right",timeout:4e3})},firstCaps:function(t){if(null!=t)return t.charAt(0).toUpperCase()+t.slice(1).toLowerCase()}},filters:{firstCaps:function(t){if(null!=t)return t.charAt(0).toUpperCase()+t.slice(1).toLowerCase()},formatAmount:function(t){return t.toString().replace(/\B(?=(\d{3})+(?!\d))/g,",")}}},v=d,m=(s("dbc3"),s("2877")),_=Object(m["a"])(v,a,i,!1,null,"851f844a",null);e["default"]=_.exports},dbc3:function(t,e,s){"use strict";var a=s("e791"),i=s.n(a);i.a},e791:function(t,e,s){}}]);