using System;

namespace Amt2k.Protocol
{
	public class Checksum : IChecksum
	{
		#region IChecksum implementation

		/// <summary>
		/// Método para calculo do Checksum - último byte do pacote
		/// </summary>
		/// <param name="data"></param>
		/// <returns></returns>
		public byte Calculate(byte[] data)
		{
			byte xor = 0;

			foreach (var b in data) {
				xor ^= b;
			}

			xor ^= 0xFF;

			return xor;
		}
 
		#endregion
	}
}

