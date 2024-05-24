describe('Búsqueda desde el navbar', () => {
    it('verifica que la barra de busqueda funcione al presionar `enter`', () => {
        cy.visit('/login');

        const navbarSearchForm = cy.findByLabelText('Barra de busqueda');
        const navbarInput = navbarSearchForm.findByLabelText('Palabras clave');

        navbarInput.type('Blockchain{enter}');

        const searchForm = cy.findByRole('form', { name: 'Formulario de búsqueda'});
        const keywordInput = searchForm.findByLabelText('Palabras Clave:');
        
        keywordInput.should('have.value', 'Blockchain');

    });

    it('verifica que la barra de busqueda funcione al presionar el boton `Buscar`', () => {
        cy.visit('/login');

        const navbarSearchForm = cy.findByLabelText('Barra de busqueda');
        const navbarInput = navbarSearchForm.findByLabelText('Palabras clave');
        const submitButton = cy.findByText('Buscar');

        navbarInput.type('Blockchain');
        submitButton.click();
        

        const searchForm = cy.findByRole('form', { name: 'Formulario de búsqueda'});
        const keywordInput = searchForm.findByLabelText('Palabras Clave:');
        
        keywordInput.should('have.value', 'Blockchain');

    });
});
