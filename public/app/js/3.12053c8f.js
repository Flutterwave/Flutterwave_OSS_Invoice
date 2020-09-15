(window["webpackJsonp"]=window["webpackJsonp"]||[]).push([[3],{5874:function(t,e,r){"use strict";r.r(e);var a=function(){var t=this,e=t.$createElement,r=t._self._c||e;return r("q-page",{staticClass:"image-background"},[r("div",{staticClass:"row justify-center"},[r("div",{staticClass:"col-6",staticStyle:{"max-width":"450px"}},[r("div",{staticClass:"text-center no-wrap",staticStyle:{"margin-top":"20%","margin-bottom":"10%"}},[r("q-img",{staticStyle:{height:"35px","max-width":"35px"},attrs:{"spinner-color":"white",src:"/app/statics/app-logo-128x128.png"}}),r("span",{staticClass:"q-pl-xs",staticStyle:{"letter-spacing":".4px","font-size":"20px","font-weight":"normal"}},[t._v("\n                        Invoices\n                    ")])],1),r("transition",{attrs:{name:"fade",tag:"div",mode:"out-in"}},[t.to_login?r("Login"):r("Register")],1)],1)])])},s=[],i=(r("8e6e"),r("8a81"),r("ac6a"),r("cadf"),r("06db"),r("456d"),r("c47a")),n=r.n(i),o=function(){var t=this,e=t.$createElement,r=t._self._c||e;return r("div",[r("p",{staticClass:"text-center q-mb-sm auth-title"},[t._v("\n        Login to your Dashboard\n    ")]),r("q-card",{staticClass:"card no-shadow"},[r("q-card-section",[r("q-form",{staticClass:"q-py-sm"},[r("div",{},[r("div",{staticClass:"q-pb-sm"},[t._v("Email Address")]),r("q-input",{directives:[{name:"validate",rawName:"v-validate",value:"required|email",expression:"'required|email'"}],staticClass:"bg-white",attrs:{hint:t.errors.first("email"),name:"email",outlined:"",placeholder:"Email",type:"text"},model:{value:t.form.email,callback:function(e){t.$set(t.form,"email",e)},expression:"form.email"}})],1),r("div",{staticClass:"q-mt-md"},[r("div",{staticClass:"q-pb-sm"},[t._v("Password")]),r("q-input",{directives:[{name:"validate",rawName:"v-validate",value:"required",expression:"'required'"}],staticClass:"bg-white",attrs:{hint:t.errors.first("password"),name:"password",outlined:"",type:t.isPwd?"password":"text",placeholder:"Password"},scopedSlots:t._u([{key:"append",fn:function(){return[r("q-icon",{staticClass:"cursor-pointer",attrs:{name:t.isPwd?"visibility_off":"visibility"},on:{click:function(e){t.isPwd=!t.isPwd}}})]},proxy:!0}]),model:{value:t.form.password,callback:function(e){t.$set(t.form,"password",e)},expression:"form.password"}})],1),r("div",{staticClass:"q-mt-md"},[r("q-btn",{attrs:{flat:"",color:"primary q-pr-none","no-caps":"",label:"Forgot your Password?"}})],1),r("div",{staticClass:"text-center"},[r("q-btn",{staticClass:"q-mt-md full-width text-bold",staticStyle:{height:"50px","border-radius":"4px","background-color":"#F5A623"},attrs:{label:"Login","no-caps":"","text-color":"white",unelevated:"",loading:t.loading},on:{click:t.login}})],1),r("div",{staticClass:"q-mt-md"},[t._v("\n                    Don't have an account?\n                    "),r("q-btn",{attrs:{flat:"",dense:"",color:"primary q-pr-none","no-caps":"",label:"Sign up"},on:{click:t.gotoRegister}})],1)])],1)],1)],1)},c=[],l=r("967e"),u=r.n(l),d=(r("a481"),r("96cf"),r("fa84")),p=r.n(d),m=r("b012"),f=r("2f62"),v=r("5935");function b(t,e){var r=Object.keys(t);if(Object.getOwnPropertySymbols){var a=Object.getOwnPropertySymbols(t);e&&(a=a.filter((function(e){return Object.getOwnPropertyDescriptor(t,e).enumerable}))),r.push.apply(r,a)}return r}function g(t){for(var e=1;e<arguments.length;e++){var r=null!=arguments[e]?arguments[e]:{};e%2?b(Object(r),!0).forEach((function(e){n()(t,e,r[e])})):Object.getOwnPropertyDescriptors?Object.defineProperties(t,Object.getOwnPropertyDescriptors(r)):b(Object(r)).forEach((function(e){Object.defineProperty(t,e,Object.getOwnPropertyDescriptor(r,e))}))}return t}var h={name:"Login",data:function(){return{loading:!1,isPwd:!0,form:{email:"salvation@flutterwavego.com",password:"password"},form_rules:{username:"required|max:50",password:"required|min:8",grant_type:"required"}}},computed:g(g({},Object(f["c"])("auth",["isAuth"])),Object(v["b"])("auth",["to_login"])),methods:g({login:function(){var t=this;return p()(u.a.mark((function e(){var r,a,s;return u.a.wrap((function(e){while(1)switch(e.prev=e.next){case 0:return e.next=2,t.$validator.validateAll();case 2:if(r=e.sent,!r){e.next=12;break}return t.loading=!0,e.next=7,m["a"].getCookie();case 7:return e.next=9,m["a"].login(t.form);case 9:a=e.sent,a.data.status?(t.setAuthStatus(!0),t.setUserData(_.get(a,["data","data","user"],{})),t.$q.notify({color:"positive",icon:"check_circle",message:a.data.msg,position:"top-right"}),s=_.get(t.$route,["query","redirect"]),s?t.$router.replace(s):t.$router.replace("/invoices")):t.$q.notify({color:"negative",icon:"cancel",message:a.data.msg,position:"top-right"}),t.loading=!1;case 12:case"end":return e.stop()}}),e)})))()},gotoRegister:function(){this.to_login=!this.to_login}},Object(f["b"])("auth",["setAuthStatus","setUserData"])),beforeRouteEnter:function(t,e,r){r((function(t){t.isAuth&&t.$router.replace({name:"public.index"})}))}},w=h,q=r("42e1"),y=Object(q["a"])(w,o,c,!1,null,"71a994d6",null),x=y.exports,O=function(){var t=this,e=t.$createElement,r=t._self._c||e;return r("div",[r("p",{staticClass:"text-center q-mb-sm auth-title"},[t._v("\n        Register to create invoices\n    ")]),r("q-card",{staticClass:"card no-shadow"},[r("q-card-section",[r("q-form",{staticClass:"q-py-sm"},[r("div",{},[r("div",{staticClass:"q-pb-sm"},[t._v("First Name")]),r("q-input",{directives:[{name:"validate",rawName:"v-validate",value:"required",expression:"'required'"}],staticClass:"bg-white",attrs:{hint:t.errors.first("first name"),name:"first name",outlined:"",placeholder:"First Name",type:"text"},model:{value:t.form.f_name,callback:function(e){t.$set(t.form,"f_name",e)},expression:"form.f_name"}})],1),r("div",{staticClass:"q-mt-md"},[r("div",{staticClass:"q-pb-sm"},[t._v("Last Name")]),r("q-input",{directives:[{name:"validate",rawName:"v-validate",value:"required",expression:"'required'"}],staticClass:"bg-white",attrs:{hint:t.errors.first("last name"),name:"last name",outlined:"",placeholder:"Last Name",type:"text"},model:{value:t.form.l_name,callback:function(e){t.$set(t.form,"l_name",e)},expression:"form.l_name"}})],1),r("div",{staticClass:"q-mt-md"},[r("div",{staticClass:"q-pb-sm"},[t._v("Phone")]),r("q-input",{staticClass:"bg-white",attrs:{hint:t.errors.first("phone"),name:"phone",outlined:"",placeholder:"Phone",type:"text"},model:{value:t.form.phone,callback:function(e){t.$set(t.form,"phone",e)},expression:"form.phone"}})],1),r("div",{staticClass:"q-mt-md"},[r("div",{staticClass:"q-pb-sm"},[t._v("Country")]),r("q-select",{directives:[{name:"validate",rawName:"v-validate",value:"required",expression:"'required'"}],attrs:{hint:t.errors.first("country"),name:"country","input-debounce":"200","bg-color":"white",outlined:"","use-input":"","hide-selected":"","fill-input":"",options:t.countries_options,dense:"","emit-value":"","map-options":""},on:{filter:t.filterFn},model:{value:t.form.country,callback:function(e){t.$set(t.form,"country",e)},expression:"form.country"}})],1),r("div",{staticClass:"q-mt-md"},[r("div",{staticClass:"q-pb-sm"},[t._v("Email Address")]),r("q-input",{directives:[{name:"validate",rawName:"v-validate",value:"required|email",expression:"'required|email'"}],staticClass:"bg-white",attrs:{hint:t.errors.first("email"),name:"email",outlined:"",placeholder:"Email",type:"text"},model:{value:t.form.email,callback:function(e){t.$set(t.form,"email",e)},expression:"form.email"}})],1),r("div",{staticClass:"q-mt-md"},[r("div",{staticClass:"q-pb-sm"},[t._v("Password")]),r("q-input",{directives:[{name:"validate",rawName:"v-validate",value:"required",expression:"'required'"}],ref:"password",staticClass:"bg-white",attrs:{hint:t.errors.first("password"),name:"password",outlined:"",type:t.isPwd?"password":"text",placeholder:"Password"},scopedSlots:t._u([{key:"append",fn:function(){return[r("q-icon",{staticClass:"cursor-pointer",attrs:{name:t.isPwd?"visibility_off":"visibility"},on:{click:function(e){t.isPwd=!t.isPwd}}})]},proxy:!0}]),model:{value:t.form.password,callback:function(e){t.$set(t.form,"password",e)},expression:"form.password"}})],1),r("div",{staticClass:"q-mt-md"},[r("div",{staticClass:"q-pb-sm"},[t._v("Confirm Password")]),r("q-input",{directives:[{name:"validate",rawName:"v-validate",value:"required|confirmed:password",expression:"'required|confirmed:password'"}],attrs:{hint:t.errors.first("confirm password"),"bg-color":"white",dense:"","error-message":"The password confirmation does not match ",placeholder:"Confirm Password",name:"confirm password",outlined:"",type:t.isPwd?"password":"text"},scopedSlots:t._u([{key:"append",fn:function(){return[r("q-icon",{staticClass:"cursor-pointer",attrs:{name:t.isPwd?"visibility_off":"visibility"},on:{click:function(e){t.isPwd=!t.isPwd}}})]},proxy:!0}]),model:{value:t.form.password_confirmation,callback:function(e){t.$set(t.form,"password_confirmation",e)},expression:"form.password_confirmation"}})],1),r("div",{staticClass:"text-center q-mt-md"},[r("q-btn",{staticClass:"q-mt-md full-width text-bold",staticStyle:{height:"50px","border-radius":"4px","background-color":"#F5A623"},attrs:{label:"Register","no-caps":"","text-color":"white",unelevated:""},on:{click:t.register}})],1),r("div",{staticClass:"q-mt-md"},[r("q-btn",{attrs:{flat:"",dense:"",color:"primary q-pr-none","no-caps":"",icon:"arrow_back",label:"Back to login"},on:{click:t.gotoLogin}})],1)])],1)],1)],1)},C=[],P=r("a685");function j(t,e){var r=Object.keys(t);if(Object.getOwnPropertySymbols){var a=Object.getOwnPropertySymbols(t);e&&(a=a.filter((function(e){return Object.getOwnPropertyDescriptor(t,e).enumerable}))),r.push.apply(r,a)}return r}function k(t){for(var e=1;e<arguments.length;e++){var r=null!=arguments[e]?arguments[e]:{};e%2?j(Object(r),!0).forEach((function(e){n()(t,e,r[e])})):Object.getOwnPropertyDescriptors?Object.defineProperties(t,Object.getOwnPropertyDescriptors(r)):j(Object(r)).forEach((function(e){Object.defineProperty(t,e,Object.getOwnPropertyDescriptor(r,e))}))}return t}var $=[],S={name:"Register",data:function(){return{loading:!1,isPwd:!0,form:{f_name:"Salvation",l_name:"Arinze",phone:"07032741119",email:"salvation@flutterwavego.com",password:"password",password_confirmation:"password",country:null},countries_options:null,form_rules:{username:"required|max:50",password:"required|min:8",grant_type:"required"}}},computed:k(k({},Object(f["c"])("auth",["isAuth"])),Object(v["b"])("auth",["to_login"])),created:function(){this.fetchCountries()},methods:k({filterFn:function(t,e){var r=this;e((function(){if(""===t)r.countries_options=$;else{var e=t.toLowerCase();r.countries_options=$.filter((function(t){return t.label.toLowerCase().indexOf(e)>-1}))}}))},fetchCountries:function(){var t=this;return p()(u.a.mark((function e(){var r;return u.a.wrap((function(e){while(1)switch(e.prev=e.next){case 0:return e.next=2,P["a"].fetchCountries();case 2:r=e.sent,r.data.status?($=r.data.countries,t.countries_options=$,t.form.country=162):t.$q.notify({color:"negative",icon:"close",message:r.data.msg,position:"top-right"});case 4:case"end":return e.stop()}}),e)})))()},register:function(){var t=this;return p()(u.a.mark((function e(){var r,a;return u.a.wrap((function(e){while(1)switch(e.prev=e.next){case 0:return e.next=2,t.$validator.validateAll();case 2:if(r=e.sent,!r){e.next=10;break}return t.loading=!0,e.next=7,m["a"].registerUser(t.form);case 7:a=e.sent,a.data.status?(t.$q.notify({color:"positive",icon:"done",message:a.data.msg,position:"top-right"}),t.gotoLogin()):t.$q.notify({color:"negative",icon:"cancel",message:a.data.msg,position:"top-right"}),t.loading=!1;case 10:case"end":return e.stop()}}),e)})))()},gotoLogin:function(){this.to_login=!this.to_login},resetForm:function(){this.form={}}},Object(f["b"])("auth",["setAuthStatus","setUserData"]))},D=S,E=(r("70bc"),Object(q["a"])(D,O,C,!1,null,"4df44699",null)),A=E.exports;function L(t,e){var r=Object.keys(t);if(Object.getOwnPropertySymbols){var a=Object.getOwnPropertySymbols(t);e&&(a=a.filter((function(e){return Object.getOwnPropertyDescriptor(t,e).enumerable}))),r.push.apply(r,a)}return r}function N(t){for(var e=1;e<arguments.length;e++){var r=null!=arguments[e]?arguments[e]:{};e%2?L(Object(r),!0).forEach((function(e){n()(t,e,r[e])})):Object.getOwnPropertyDescriptors?Object.defineProperties(t,Object.getOwnPropertyDescriptors(r)):L(Object(r)).forEach((function(e){Object.defineProperty(t,e,Object.getOwnPropertyDescriptor(r,e))}))}return t}var F={name:"LoginTemplate",components:{Register:A,Login:x},data:function(){return{}},computed:N({},Object(v["b"])("auth",["to_login"])),methods:{}},R=F,U=(r("9831"),r("6c53"),Object(q["a"])(R,a,s,!1,null,"0d21ccda",null));e["default"]=U.exports},"6c53":function(t,e,r){"use strict";var a=r("9bc7"),s=r.n(a);s.a},"70bc":function(t,e,r){"use strict";var a=r("b8b6"),s=r.n(a);s.a},9831:function(t,e,r){"use strict";var a=r("e168"),s=r.n(a);s.a},"9bc7":function(t,e,r){},a685:function(t,e,r){"use strict";r.d(e,"a",(function(){return n}));var a=r("6fea"),s=r("bc3a"),i=r.n(s),n={fetchCountries:function(){return i.a.get(a["a"].api("utils/fetchCountries"))},fetchCurrencies:function(){return i.a.get(a["a"].api("utils/fetchCurrencies"))}}},b8b6:function(t,e,r){},e168:function(t,e,r){}}]);