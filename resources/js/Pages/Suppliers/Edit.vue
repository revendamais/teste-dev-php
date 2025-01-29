// filepath: /c:/Users/evtit/Documents/Desenvolvimento/AL/php/teste-php-app/resources/js/Pages/Suppliers/Edit.vue
<script setup lang="ts">
import { Head, Link, useForm } from '@inertiajs/vue3';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import InputLabel from '@/Components/InputLabel.vue';
import TextInput from '@/Components/TextInput.vue';
import TextInputMask from '@/Components/TextInputMask.vue';
import InputError from '@/Components/InputError.vue';
import { fetchCnpjData } from './Suppliers';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import { alert, setAlert } from '@/Components/Alert/Alert';
import Alert from '@/Components/Alert/Alert.vue';

const props = defineProps<{
    supplier: {
        id: number,
        name: string,
        registration_number: string,
        email: string,
        phone: string,
        address: {
            street: string,
            city: string,
            state: string,
            postal_code: string,
            country: string
        }
    }
}>();

const supplier = props.supplier;

const form = useForm({
    name: supplier.name,
    registration_number: supplier.registration_number,
    email: supplier.email,
    phone: supplier.phone,
    address: {
        street: supplier.address?.street || '',
        city: supplier.address?.city || '',
        state: supplier.address?.state || '',
        postal_code: supplier.address?.postal_code || '',
        country: supplier.address?.country || '',
    }
});

const submit = () => {
    form.put(route('suppliers.update', supplier.id), {
        onFinish: () => {
            if (form.recentlySuccessful) {
                form.reset();
                setAlert('Fornecedor atualizado com sucesso!', 'bg-green-500', 'text-white');
            }
        },
        onError: () => {
            setAlert('Erro ao atualizar fornecedor.', 'bg-red-500', 'text-white');
        }
    });
};

async function handleBlur() {
    if (form.registration_number) {
        const registration_number = form.registration_number.replace(/\D/g, '');
        await fetchCnpjData(registration_number, form);
    }
}
</script>

<template>

    <Head title="Editar Fornecedor" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="text-xl font-semibold leading-tight text-gray-800">
                Editar Fornecedor
            </h2>

            <div class="pt-2">
                <Alert v-if="alert.show" :backgroundColor="alert.backgroundColor" :textColor="alert.textColor"
                    :message="alert.message" />
            </div>
        </template>

        <div class="py-12">
            <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
                <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900">
                        <form @submit.prevent="submit" class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div class="mb-4">
                                <InputLabel for="registration_number" value="CNPJ" />

                                <TextInputMask id="registration_number" type="text" class="mt-1 block w-full"
                                    v-model="form.registration_number" required @blur="handleBlur"
                                    :mask="'##.###.###/####-##'" />

                                <InputError class="mt-2" :message="form.errors.registration_number" />
                            </div>

                            <div class="mb-4">
                                <InputLabel for="name" value="Nome" />

                                <TextInput id="name" type="text" class="mt-1 block w-full" v-model="form.name"
                                    required />

                                <InputError class="mt-2" :message="form.errors.name" />
                            </div>

                            <div class="mb-4">
                                <InputLabel for="email" value="E-mail" />

                                <TextInput id="email" type="email" class="mt-1 block w-full" v-model="form.email"
                                    required />

                                <InputError class="mt-2" :message="form.errors.email" />
                            </div>

                            <div class="mb-4">
                                <InputLabel for="phone" value="Telefone" />

                                <TextInputMask id="phone" type="text" class="mt-1 block w-full" v-model="form.phone"
                                    required :mask="'(##) ####-####'" />

                                <InputError class="mt-2" :message="form.errors.phone" />
                            </div>

                            <div class="mb-4">
                                <InputLabel for="address_street" value="Endereço" />

                                <TextInput id="address_street" type="text" class="mt-1 block w-full"
                                    v-model="form.address.street" />
                            </div>

                            <div class="mb-4">
                                <InputLabel for="address_city" value="Cidade" />

                                <TextInput id="address_city" type="text" class="mt-1 block w-full"
                                    v-model="form.address.city" />
                            </div>

                            <div class="mb-4">
                                <InputLabel for="address_state" value="Estado" />

                                <TextInput id="address_state" type="text" class="mt-1 block w-full"
                                    v-model="form.address.state" />
                            </div>

                            <div class="mb-4">
                                <InputLabel for="address_postal_code" value="CEP" />

                                <TextInputMask id="address_postal_code" type="text" class="mt-1 block w-full"
                                    v-model="form.address.postal_code" :mask="'#####-###'" />
                            </div>

                            <div class="mb-4">
                                <InputLabel for="address_country" value="País" />

                                <TextInput id="address_country" type="text" class="mt-1 block w-full"
                                    v-model="form.address.country" />
                            </div>

                            <div class="flex items-center gap-4 justify-end">
                                <PrimaryButton class="ms-4" :class="{ 'opacity-25': form.processing }"
                                    :disabled="form.processing">
                                    Atualizar
                                </PrimaryButton>

                                <Link :href="route('suppliers.index')" class="text-gray-600 hover:text-gray-900">
                                Cancelar</Link>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>