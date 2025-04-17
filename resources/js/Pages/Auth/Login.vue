<script setup>
import Container from "../../components/Container.vue";
import ErrorMessages from "../../components/ErrorMessages.vue";
import InputField from "../../components/InputField.vue";
import PrimaryBtn from "../../components/PrimaryBtn.vue";
import TextLink from "../../components/TextLink.vue";
import Title from "../../components/Title.vue";
import { useForm } from "@inertiajs/vue3";
import SessionMessages from "../../components/SessionMessages.vue";

const form=useForm({

email:"",
password:"",

});

defineProps({
    status:String
})
const submit=()=>{
    form.post(route('login'),{
        onFinish:()=>form.reset('password')
    });

}

</script>

<template>
    <Container class="w-1/2">
        <div class="mb-8 text-center">
            <Title> Login</Title>
            <p>
               Don't have an account?
                <TextLink routeName="register" label="Register" />
            </p>
        </div>
<ErrorMessages :errors="form.errors"/>
<SessionMessages :status="status"/>
        <form @submit.prevent="submit" class="space-y-6">


            <InputField v-model="form.email" label="Email" type="email" icon="at" />

            <InputField v-model="form.password" label="Password" type="password" icon="key" />
<p>
    <TextLink routeName="password.request" label="Forgot Password?" />
</p>


            <PrimaryBtn :disabled="form.processing">Login</PrimaryBtn>
        </form>
    </Container>
</template>
