<script setup>
import Container from "../../components/Container.vue";
import ErrorMessages from "../../components/ErrorMessages.vue";
import InputField from "../../components/InputField.vue";
import PrimaryBtn from "../../components/PrimaryBtn.vue";
import TextLink from "../../components/TextLink.vue";
import Title from "../../components/Title.vue";
import { useForm } from "@inertiajs/vue3";

const form=useForm({
name:"",
email:"",
password:"",
password_confirmation:""
});


const submit=()=>{
    form.post(route('register'),{
        onFinish:()=>form.reset('password','password_confirmation')
    });

}

</script>

<template>
    <Container class="w-1/2">
        <div class="mb-8 text-center">
            <Title>Register a new account</Title>
            <p>
                Already have an account?
                <TextLink routeName="login" label="Login" />
            </p>
        </div>
<ErrorMessages :errors="form.errors"/>
        <form @submit.prevent="submit" class="space-y-6">
            <InputField v-model="form.name" label="Name" icon="id-badge" />

            <InputField v-model="form.email" label="Email" type="email" icon="at" />

            <InputField v-model="form.password" label="Password" type="password" icon="key" />

            <InputField v-model="form.password_confirmation" label="Confirm Password" type="password" icon="key" />

            <p class="text-slate-500 text-sm dark:text-slate-400">
                By creating an account, you agree to our Terms of Service and
                Privacy Policy.
            </p>

            <PrimaryBtn :disabled="form.processing">Register</PrimaryBtn>
        </form>
    </Container>
</template>
