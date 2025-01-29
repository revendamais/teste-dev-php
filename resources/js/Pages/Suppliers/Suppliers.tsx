export interface CnpjData {
    razao_social?: string;
    email?: string;
    ddd_telefone_1?: string;
    descricao_tipo_de_logradouro?: string;
    numero?: string;
    logradouro?: string;
    municipio?: string;
    uf?: string;
    cep?: string;
}

export function populateFormWithCnpjData(cnpjData: CnpjData, form: any) {
    if (cnpjData) {
        form.name = cnpjData.razao_social || '';
        if (!form.email) {
            form.email = cnpjData.email || '';
        }
        if (!form.phone) {
            form.phone = cnpjData.ddd_telefone_1 || '';
        }
        form.address.street = (cnpjData.descricao_tipo_de_logradouro || '') + ' ' + (cnpjData.logradouro || '') + ', ' + (cnpjData.numero || '');
        form.address.city = cnpjData.municipio || '';
        form.address.state = cnpjData.uf || '';
        form.address.postal_code = cnpjData.cep || '';
        form.address.country = 'Brasil';
    }
}

export async function fetchCnpjData(registration_number: string, form: any) {
    try {
        const response = await fetch(`/cnpj/${registration_number}`);
        
        if (response.ok) {
            form.errors.registration_number = '';

            const cnpjData: CnpjData = await response.json();
            populateFormWithCnpjData(cnpjData, form);
        } else {
            const errorData = await response.json();
            form.errors.registration_number = errorData.message || 'Erro ao buscar dados do CNPJ';            
        }
    } catch (error) {
        console.error('Error fetching CNPJ data:', error);
    }
}
