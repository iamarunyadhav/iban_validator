import{T as n,c as l,o as d,w as t,a as e,u as a,Z as p,b as r,d as u,n as f,e as c}from"./app-qXnbWj1i.js";import{_ as w}from"./GuestLayout-BlCgWSdr.js";import{_,a as b,b as x}from"./TextInput-DvEKD5C1.js";import{P as g}from"./PrimaryButton-1LfP1PcC.js";import"./ApplicationLogo-DyKlNqal.js";import"./_plugin-vue_export-helper-DlAUqK2U.js";const y={class:"flex justify-end mt-4"},T={__name:"ConfirmPassword",setup(P){const s=n({password:""}),i=()=>{s.post(route("password.confirm"),{onFinish:()=>s.reset()})};return(V,o)=>(d(),l(w,null,{default:t(()=>[e(a(p),{title:"Confirm Password"}),o[2]||(o[2]=r("div",{class:"mb-4 text-sm text-gray-600"}," This is a secure area of the application. Please confirm your password before continuing. ",-1)),r("form",{onSubmit:c(i,["prevent"])},[r("div",null,[e(_,{for:"password",value:"Password"}),e(b,{id:"password",type:"password",class:"mt-1 block w-full",modelValue:a(s).password,"onUpdate:modelValue":o[0]||(o[0]=m=>a(s).password=m),required:"",autocomplete:"current-password",autofocus:""},null,8,["modelValue"]),e(x,{class:"mt-2",message:a(s).errors.password},null,8,["message"])]),r("div",y,[e(g,{class:f(["ms-4",{"opacity-25":a(s).processing}]),disabled:a(s).processing},{default:t(()=>o[1]||(o[1]=[u(" Confirm ")])),_:1},8,["class","disabled"])])],32)]),_:1}))}};export{T as default};
