<script setup>
import Container from "../../components/Container.vue";
import ErrorMessages from "../../components/ErrorMessages.vue";
import InputField from "../../components/InputField.vue";
import PrimaryBtn from "../../components/PrimaryBtn.vue";
import TextLink from "../../components/TextLink.vue";
import Title from "../../components/Title.vue";
import { useForm } from "@inertiajs/vue3";
import SessionMessages from "../../components/SessionMessages.vue";


const props = defineProps({
    token:String,
    email:String,status:String
})
const form=useForm({
token:props.token,
email:props.email,
password:"",
password_confirmation:""
});


const submit=()=>{
    form.post(route('password.update'),{
        onFinish:()=>form.reset('password','password_confirmation')
    });

}

</script>

<template>
    <Container class="w-1/2">
        <div class="mb-8 text-center">
            <Title>Enter a new password</Title>

        </div>
<ErrorMessages :errors="form.errors"/>
<SessionMessages :status="props.status"/>
        <form @submit.prevent="submit" class="space-y-6">


            <InputField v-model="form.email" label="Email" type="email" icon="at" />

            <InputField v-model="form.password" label="Password" type="password" icon="key" />

            <InputField v-model="form.password_confirmation" label="Confirm Password" type="password" icon="key" />


            <PrimaryBtn :disabled="form.processing">New Password</PrimaryBtn>
        </form>
    </Container>
</template>
