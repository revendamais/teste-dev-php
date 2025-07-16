private static short calcularCRC(List<Integer> dadosEntrada) {
		List<Short> listaComZeros = new ArrayList<Short>();
		for (int i = 0; i<dadosEntrada.size(); i++) {
			listaComZeros.add((short) (dadosEntrada.get(i) & 0xFF));
		}
		listaComZeros.add((short) 0);
		listaComZeros.add((short) 0);
		int CRC = 0;
		
		int CRCByteCount = 0;
		for (int i = 0; i < listaComZeros.size(); i++) {
			/*
			 * na primeira chamada preenche o byte 2
			 * na segunda o byte 1
			 * e nas demais preenche o byte 0
			 */
			int leftShift = 8 * (2 - CRCByteCount);
			CRC = CRC & (((int) 0xFF << leftShift) ^ (int) 0xFFFFFFFF);
			CRC = (CRC | (listaComZeros.get(i) << leftShift));
			if (CRCByteCount < 2) {
				CRCByteCount++;
			} else {// quando os bytes de 0 a 2 estiverem preenchidos
				for (int j = 0; j < 8; j++) { // desloca o valor armazenado 8 posic¸o~es para a esquerda, 1 bit por vez
					CRC = (CRC << 1);
					if ((CRC & 0x1000000) == 0x1000000 ) {// se o bit menos significativo do byte 3 estiver em 1
						CRC = (CRC ^ 0x00800500);// executa um XOR do valor armazenado com a constante 0x00800500
					}
				}
			}
		}
		CRC = ((((CRC >>> 16) & 0xFF) << 8) | ((CRC >>> 8) & 0xFF));
		return (short) (CRC & 0xFFFF);
	}
	
	/**
	 * Retorna a parte "Hi" do CRC.
	 * @param CRC
	 * @return Parte "Hi" do CRC.
	 */
	private static int extrairCRCHi(short CRC) {
		return (byte) ((CRC & 0xFF00) >>> 8);
	}

	/**
	 * Retorna a parte "Low" do CRC.
	 * @param CRC
	 * @return Parte "Low" do CRC.
	 */
	private static int extrairCRCLo(short CRC) {
		return (byte) (CRC & 0x00FF);
	}