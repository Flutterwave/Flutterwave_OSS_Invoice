(window["webpackJsonp"]=window["webpackJsonp"]||[]).push([[10],{9365:function(t,e,s){},c2c3:function(t,e,s){"use strict";s.r(e);var a=function(){var t=this,e=t.$createElement,s=t._self._c||e;return s("div",{staticClass:"bg-white shadow-custom main-section"},[s("section",{staticClass:"row justify-between q-px-lg q-py-lg"},[s("div",{staticClass:"q-mt-auto q-mb-auto text-bold"},[t.invoices?s("div",[t._v(t._s(t.invoices.total)+" invoice"+t._s(t.invoices.total>1?"s":""))]):s("div",[s("q-skeleton",{attrs:{type:"rect",width:"10rem"}})],1)]),s("div",{staticClass:"q-gutter-md no-wrap action-btns"},[s("q-btn",{staticClass:"shadow-btn text-bold",attrs:{color:"white",icon:"filter_alt",label:"Filter","no-caps":"","text-color":"black",unelevated:""}},[s("q-menu",{attrs:{offset:[0,15],anchor:"bottom right",self:"top right"}},[s("section",{staticStyle:{width:"320px"}},[s("div",{staticClass:"filter-section"},[s("div",{staticClass:"row q-pl-lg q-py-sm text-bold filter-header"},[t._v("Email")]),s("q-input",{staticClass:"q-my-md q-mx-md",attrs:{dense:"",outlined:"",placeholder:"Email"},model:{value:t.filter.email,callback:function(e){t.$set(t.filter,"email",e)},expression:"filter.email"}})],1),s("div",{staticClass:"filter-section"},[s("div",{staticClass:"row q-pl-lg q-py-sm text-bold filter-header"},[t._v("Date")]),s("div",{staticClass:"row justify-around no-wrap q-my-md q-mx-sm"},[s("q-input",{staticClass:"col-5",attrs:{dense:"",outlined:"",placeholder:"From"},on:{click:function(e){return t.$refs.dateFrom.show()}},scopedSlots:t._u([{key:"append",fn:function(){return[s("div",[s("q-popup-proxy",{ref:"dateFrom",attrs:{"context-menu":"","transition-hide":"scale","transition-show":"scale"}},[s("q-date",{attrs:{color:"theme-orange",mask:"DD-MM-YYYY"},on:{input:function(){t.$refs.dateFrom.hide()}},model:{value:t.filter.date_range.from,callback:function(e){t.$set(t.filter.date_range,"from",e)},expression:"filter.date_range.from"}})],1)],1)]},proxy:!0}]),model:{value:t.filter.date_range.from,callback:function(e){t.$set(t.filter.date_range,"from",e)},expression:"filter.date_range.from"}}),s("q-input",{staticClass:"col-5",attrs:{dense:"",outlined:"",placeholder:"To"},on:{click:function(e){return t.$refs.dateTo.show()}},scopedSlots:t._u([{key:"append",fn:function(){return[s("div",[s("q-popup-proxy",{ref:"dateTo",attrs:{"context-menu":"","transition-hide":"scale","transition-show":"scale"}},[s("q-date",{attrs:{color:"theme-orange",mask:"DD-MM-YYYY"},on:{input:function(){t.$refs.dateTo.hide()}},model:{value:t.filter.date_range.to,callback:function(e){t.$set(t.filter.date_range,"to",e)},expression:"filter.date_range.to"}})],1)],1)]},proxy:!0}]),model:{value:t.filter.date_range.to,callback:function(e){t.$set(t.filter.date_range,"to",e)},expression:"filter.date_range.to"}})],1)]),s("div",{staticClass:"filter-section"},[s("div",{staticClass:"row q-pl-lg q-py-sm text-bold filter-header"},[t._v("Status")]),s("div",{staticClass:"row justify-around q-my-md q-mx-md"},[s("q-checkbox",{attrs:{dense:"",label:"Due",val:"due"},model:{value:t.filter.status,callback:function(e){t.$set(t.filter,"status",e)},expression:"filter.status"}}),s("q-checkbox",{attrs:{dense:"",label:"Paid",val:"paid"},model:{value:t.filter.status,callback:function(e){t.$set(t.filter,"status",e)},expression:"filter.status"}}),s("q-checkbox",{attrs:{dense:"",label:"Issued",val:"issued"},model:{value:t.filter.status,callback:function(e){t.$set(t.filter,"status",e)},expression:"filter.status"}}),s("q-checkbox",{attrs:{dense:"",label:"Draft",val:"draft"},model:{value:t.filter.status,callback:function(e){t.$set(t.filter,"status",e)},expression:"filter.status"}})],1)]),s("div",{staticClass:"filter-section"},[s("div",{staticClass:"row justify-between q-px-md q-py-sm"},[s("q-btn",{staticClass:"shadow-btn text-bold",attrs:{label:"Reset",size:"sm",unelevated:""},on:{click:t.resetFilter}}),s("q-btn",{staticClass:"shadow-btn text-bold",attrs:{color:"orange-4",label:"Filter","no-caps":"",size:"sm","text-color":"white",unelevated:""},on:{click:t.filterInvoices}})],1)])])])],1),s("q-btn",{staticClass:"shadow-btn text-bold",attrs:{to:"invoices/create",color:"orange-4",label:"New Invoice","no-caps":"","text-color":"white",unelevated:""}}),s("json-excel",{staticClass:" inline-block",staticStyle:{"vertical-align":"middle"},attrs:{"export-fields":t.csv_fields,fetch:t.exportData,name:"Invoices.csv",type:"csv"}},[s("q-btn",{staticClass:"shadow-btn text-bold",attrs:{color:"white",icon:"description",label:"Export","no-caps":"","text-color":"black",unelevated:""}})],1)],1)]),t.invoices?s("section",[t.invoices.total?[s("q-markup-table",{staticClass:"no-shadow"},[s("thead",[s("tr",[s("th",{staticClass:"text-center"},[t._v("Status")]),s("th",{staticClass:"text-left"},[t._v("Ref.")]),s("th",{staticClass:"text-left"},[t._v("Client")]),s("th",{staticClass:"text-left"},[t._v("Amount")]),s("th",{staticClass:"text-left"},[t._v("Date Created")]),s("th",{staticClass:"text-left"},[t._v("Due Date")])])]),s("tbody",t._l(t.invoices.data,(function(e,a){return s("tr",{key:t.invoices.id,staticClass:"ref_table_body",on:{click:function(s){return t.gotoDetails(e.id)}}},[t.processing?t._l(6,(function(t){return s("td",{staticClass:"text-left"},[s("q-skeleton",{attrs:{type:"rect"}})],1)})):[s("td",{staticClass:"text-center"},[s("q-chip",{class:{"bg-light-blue-4":"draft"===e.status,"bg-amber":"issued"===e.status,"bg-green-8":"paid"===e.status,"bg-red-8":"due"===e.status,"text-white q-px-lg status":!0}},[t._v("\n                                "+t._s(t._f("firstCaps")(e.status))+"\n                            ")])],1),s("td",{staticClass:"text-left"},[t._v("#"+t._s(e.ref))]),s("td",{staticClass:"text-left"},[t._v(t._s(e.to_email))]),s("td",{staticClass:"text-left"},[t._v(t._s(e.currency.iso)+" "+t._s(e.total_amt))]),s("td",{staticClass:"text-left"},[t._v(t._s(t._f("moment")(e.created_at,"Do MMMM, YYYY")))]),s("td",{staticClass:"text-left"},[t._v(t._s(t._f("moment")(e.due_date,"Do MMMM, YYYY")))])]],2)})),0)]),s("div",{staticClass:"row justify-center q-py-lg items-center"},[s("q-btn",{staticClass:"q-mr-sm text-bold",attrs:{disable:null===t.invoices.prev_page_url,color:"primary",flat:"",label:"PREV",size:".9em"},on:{click:function(e){return t.filterInvoices("prev")}}}),s("q-btn",{staticClass:"text-bold",attrs:{disable:null===t.invoices.next_page_url,color:"primary",flat:"",label:"NEXT",size:".9em"},on:{click:function(e){return t.filterInvoices("next")}}})],1)]:[s("div",{staticClass:"q-py-lg no-wrap text-center items-center text-grey"},[s("q-icon",{staticStyle:{"font-size":"2rem"},attrs:{name:"notes"}}),s("div",{staticClass:"text-h6 text-center"},[t._v("No Invoices")]),s("div",{staticClass:"text-center q-pt-lg"},[t._v("\n                    There're no invoices yet. It could also be as a result of the filter query.\n                ")])],1)]],2):s("section",[s("q-markup-table",{staticClass:"no-shadow",attrs:{highlight:"",responsive:"",separator:"none"}},[s("tbody",t._l(5,(function(e){return s("tr",t._l(6,(function(t){return s("td",{staticClass:"text-left"},[s("q-skeleton",{attrs:{type:"rect"}})],1)})),0)})),0)])],1)])},i=[],r=(s("8e6e"),s("8a81"),s("ac6a"),s("cadf"),s("06db"),s("456d"),s("967e")),n=s.n(r),o=s("c47a"),l=s.n(o),c=(s("96cf"),s("fa84")),u=s.n(c),d=s("1bdd");function f(t,e){var s=Object.keys(t);if(Object.getOwnPropertySymbols){var a=Object.getOwnPropertySymbols(t);e&&(a=a.filter((function(e){return Object.getOwnPropertyDescriptor(t,e).enumerable}))),s.push.apply(s,a)}return s}function p(t){for(var e=1;e<arguments.length;e++){var s=null!=arguments[e]?arguments[e]:{};e%2?f(Object(s),!0).forEach((function(e){l()(t,e,s[e])})):Object.getOwnPropertyDescriptors?Object.defineProperties(t,Object.getOwnPropertyDescriptors(s)):f(Object(s)).forEach((function(e){Object.defineProperty(t,e,Object.getOwnPropertyDescriptor(s,e))}))}return t}var v={name:"InvoicesListing",meta:function(){return{title:"View All Invoices - Invoices"}},components:{JsonExcel:d["a"]},data:function(){return{dialog:!1,invoices:null,filter:{email:"",date_range:{from:"",to:""},status:[],page:1,per_page:"15"},csv_fields:{Status:"status",Ref:"ref",Currency:"currency.iso",To:"to_email",Cc:"cc_emails",Notes:"notes",Items:{field:"items",callback:function(t){var e="";return t.forEach((function(t){e+="".concat(t.item," — ").concat(t.quantity," — ").concat(t.unit_price,"; ")})),e}},"Date Created":"created_at","Date Paid":"paid_at","Due Date":"due_date"},entries:{to:"",total:""},processing:!1}},computed:{total:function(){return parseFloat(this.subtotal)+parseFloat(this.invoice.shipping_fee||0)+parseFloat(this.invoice.discount||0)+parseFloat(this.invoice.tax||0)}},created:function(){this.filterInvoices()},methods:{exportData:function(){var t=this;return u()(n.a.mark((function e(){var s;return n.a.wrap((function(e){while(1)switch(e.prev=e.next){case 0:return e.next=2,t.$axios.get("invoices/filter",{params:p({export:!0},t.filter)});case 2:return s=e.sent,e.abrupt("return",s.data.data);case 4:case"end":return e.stop()}}),e)})))()},filterInvoices:function(t){var e=this;return u()(n.a.mark((function s(){var a,i,r,o,l;return n.a.wrap((function(s){while(1)switch(s.prev=s.next){case 0:return e.processing=!0,"next"===t?e.filter.page++:"prev"===t?e.filter.page--:e.filter.page=1,s.next=4,e.$axios.get("invoices/filter",{params:e.filter});case 4:a=s.sent,i=a.data,r=i.status,o=i.msg,l=i.data,r?e.invoices=l:e.$q.notify({color:"warning",message:o,icon:"fa fa-exclamation-circle"}),e.processing=!1;case 8:case"end":return s.stop()}}),s)})))()},gotoDetails:function(t){this.$router.push("invoices/".concat(t))},resetFilter:function(){this.filter.email="",this.filter.date_range={from:"",to:""},this.filter.status=[]},firstCaps:function(t){if(null!=t)return t.charAt(0).toUpperCase()+t.slice(1).toLowerCase()}},filters:{}},m=v,b=(s("f004"),s("42e1")),h=Object(b["a"])(m,a,i,!1,null,"0197ab06",null);e["default"]=h.exports},f004:function(t,e,s){"use strict";var a=s("9365"),i=s.n(a);i.a}}]);